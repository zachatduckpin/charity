<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGlobalNetworkApplicationRequest;
use App\Models\GlobalNetworkApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class GlobalNetworkApplicationController extends Controller
{
    public function create(): View
    {
        return view('global-network.applications.form', [
            'application' => new GlobalNetworkApplication(),
        ]);
    }

    public function store(StoreGlobalNetworkApplicationRequest $request): RedirectResponse
    {
        $application = new GlobalNetworkApplication();

        return $this->saveApplication($request, $application);
    }

    public function edit(GlobalNetworkApplication $application): View
    {
        return view('global-network.applications.form', [
            'application' => $application,
        ]);
    }

    public function update(StoreGlobalNetworkApplicationRequest $request, GlobalNetworkApplication $application): RedirectResponse
    {
        return $this->saveApplication($request, $application);
    }

    public function show(GlobalNetworkApplication $application): View
    {
        return view('global-network.applications.show', [
            'application' => $application->load('documents'),
        ]);
    }

    private function saveApplication(StoreGlobalNetworkApplicationRequest $request, GlobalNetworkApplication $application): RedirectResponse
    {
        $data = Arr::except($request->validated(), ['intent', 'documents', 'photos']);
        $data['user_id'] = $application->user_id ?: Auth::id();

        if ($request->input('intent') === 'submit') {
            $data['status'] = GlobalNetworkApplication::STATUS_SUBMITTED;
            $data['submitted_at'] = now();
        } else {
            $data['status'] = GlobalNetworkApplication::STATUS_DRAFT;
        }

        $application->fill($data)->save();
        $this->storeDocuments($request, $application);
        $this->storePhotos($request, $application);

        return redirect()
            ->route('global-network.applications.show', $application)
            ->with('status', $application->isSubmitted()
                ? 'Application submitted successfully.'
                : 'Draft saved successfully.');
    }

    private function storeDocuments(StoreGlobalNetworkApplicationRequest $request, GlobalNetworkApplication $application): void
    {
        foreach ($request->file('documents', []) as $documentType => $files) {
            foreach ((array) $files as $file) {
                if (!$file) {
                    continue;
                }

                $this->storeUpload($application, $documentType, $file);
            }
        }
    }

    private function storePhotos(StoreGlobalNetworkApplicationRequest $request, GlobalNetworkApplication $application): void
    {
        $photos = $request->file('photos', []);

        foreach (['applicant_contact', 'primary_contact', 'secondary_contact', 'organization'] as $photoType) {
            if (empty($photos[$photoType])) {
                continue;
            }

            $this->storeUpload($application, "photo_{$photoType}", $photos[$photoType]);
        }

        if (!empty($photos['organization_logo'])) {
            $this->storeUpload($application, 'organization_logo', $photos['organization_logo']);
        }

        foreach ($photos['activity_examples'] ?? [] as $index => $file) {
            if (!$file) {
                continue;
            }

            $this->storeUpload($application, 'photo_activity_example_' . ($index + 1), $file);
        }
    }

    private function storeUpload(GlobalNetworkApplication $application, string $documentType, $file): void
    {
        $path = $file->store("global-network/applications/{$application->id}", 'private');

        $application->documents()->create([
            'document_type' => $documentType,
            'original_name' => $file->getClientOriginalName(),
            'path' => $path,
            'mime_type' => $file->getClientMimeType(),
            'size' => $file->getSize(),
        ]);
    }
}
