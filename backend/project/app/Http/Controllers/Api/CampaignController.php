<?php

namespace App\Http\Controllers\Api;

use App\Http\Helpers\MediaHelper;
use App\Models\Campaign;
use App\Models\CampaignGallery;
use App\Models\Donation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CampaignController extends ApiController
{

    public function index(Request $request)
    {
        $campaigns = [];
        $search = $request->search;
        switch ($request->type) {

            case 'closed':
                $campaigns = Campaign::with(['user', 'category'])
                    ->where('user_id', auth()->id())->whereStatus(2)
                    ->when($search, function ($query) use ($search) {
                        return $query->where('title', 'like', '%' . $search . '%');
                    })->latest()->paginate(10);

                break;
            case 'running':
                $campaigns = Campaign::with(['user', 'category'])->where('user_id', auth()->id())->whereStatus(1)
                    ->when($search, function ($query) use ($search) {
                        return $query->where('title', 'like', '%' . $search . '%');
                    })->latest()->paginate(10);
                break;
            case 'pending':
                $campaigns = Campaign::with(['user', 'category'])->where('user_id', auth()->id())->whereStatus(0)
                    ->when($search, function ($query) use ($search) {
                        return $query->where('title', 'like', '%' . $search . '%');
                    })->latest()->paginate(10);

                break;
            default:
                $campaigns = Campaign::with(['user', 'category'])->where('user_id', auth()->id())
                    ->when($search, function ($query) use ($search) {
                        return $query->where('title', 'like', '%' . $search . '%');
                    })
                    ->latest()->paginate(10);
                break;
        }

        return response()->json(['status' => true, 'data' => $campaigns, 'message' => 'Campaigns fetched successfully']);
    }

    public function store(Request $request)
    {
        //return response()->json(gettype($request->gallery));

        $request->validate([
            'title' => 'required|unique:campaigns,title',
            "location" => "required",
            "benefits" => "required|numeric",
            'description' => 'required',
            "end_date" => "required",
            'category_id' => 'required',
            'photo' => 'required|mimes:jpeg,jpg,png',
            'goal' => 'required',
        ]);

        $campaign = new Campaign();
        $campaign->user_id = auth()->id();
        $campaign->title = $request->title;
        $campaign->location = $request->location;
        $campaign->benefits = $request->benefits;
        $dateString = preg_replace('/\s\(.*\)$/', '', $request->end_date);
        $carbonDate = Carbon::createFromFormat('D M d Y H:i:s \G\M\TP', $dateString);
        $formattedDate = $carbonDate->format('d-m-Y H:i:s');
        $campaign->end_date = Carbon::parse($formattedDate);
        $campaign->video_link = $request->video_link;
        $campaign->slug = Str::slug($request->title);
        $campaign->description = $request->description;
        $campaign->category_id = $request->category_id;
        $campaign->goal = adminStore($request->goal);
        $campaign->photo = MediaHelper::handleMakeImage($request->photo);
        $campaign->is_faq = $request->faq_title ? 1 : 0;
        $campaign->is_preloaded = $request->is_preloaded == 'on' ? 1 : 0;
        $campaign->status = $request->status == 1 ? 1 : 0;
        $campaign->close_type = $request->close_type ?? 'goal';
        $campaign->save();

        if ($request->faq_title && $request->faq_content) {
            $faq_title = explode(',', $request->faq_title);
            if (count($faq_title) != 0) {
                foreach ($faq_title as $key => $question) {
                    $content = explode(',', $request->faq_content);
                    $campaign->faqs()->create([
                        'title' => $question ? $question : null,
                        'content' => $content[$key] ? $content[$key] : null,
                    ]);
                }
            }

        }

        if ($request->gallery) {
            foreach ($request->gallery as $key => $gallery) {
                $photo = MediaHelper::handleMakeImage($gallery);
                $campaign->galleries()->create([
                    'photo' => $photo ? $photo : null,
                ]);
            }
        }

        return response()->json(['status' => true, 'data' => [], 'message' => 'Campaign created successfully']);
    }

    public function edit($id)
    {
        $data = Campaign::with(['galleries', 'faqs'])->findOrFail($id);
        return $this->sendResponse($data, 'Single Campaign');
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'title' => 'required|unique:campaigns,title,' . $id,
            'description' => 'required',
            'category_id' => 'required',
            'photo' => 'mimes:jpeg,jpg,png',
            'goal' => 'required',
            "end_date" => "required",
        ]);

        $campaign = Campaign::findOrFail($id);
        $campaign->title = $request->title;
        $campaign->slug = Str::slug($request->title);
        $campaign->description = $request->description;
        $campaign->category_id = $request->category_id;

        $dateString = preg_replace('/\s\(.*\)$/', '', $request->end_date);
        $carbonDate = Carbon::createFromFormat('D M d Y H:i:s \G\M\TP', $dateString);
        $formattedDate = $carbonDate->format('d-m-Y H:i:s');

        $campaign->end_date = Carbon::parse($formattedDate);
        $campaign->goal = $request->goal;
        if ($request->photo) {
            $campaign->photo = MediaHelper::handleUpdateImage($request->photo, $campaign->photo);
        }

        $campaign->is_faq = $request->is_faq == 'on' ? 1 : 0;
        $campaign->is_preloaded = $request->is_preloaded == 'on' ? 1 : 0;
        $campaign->status = $request->status == 1 ? 1 : 0;
        $campaign->close_type = $request->close_type ?? 'goal';
        $campaign->update();

        $new_faq_title = explode(',', $request->faq_title);
        $new_faq_content = explode(',', $request->faq_content);

        if ($request->faq_title && $request->faq_content) {
            $campaign->faqs()->delete();
            foreach ($new_faq_title as $key => $question) {
                $campaign->faqs()->create([
                    'title' => $question ? $question : null,
                    'content' => $new_faq_content[$key] ? $new_faq_content[$key] : null,
                ]);
            }
            $campaign->is_faq = $request->is_faq == 1;
        } else {
            $campaign->is_faq = $request->is_faq == 0;
            $campaign->faqs()->delete();
        }
        $campaign->update();

        if ($request->gallery) {
            foreach ($request->gallery as $key => $gallery) {
                $photo = MediaHelper::handleMakeImage($gallery);
                $campaign->galleries()->create([
                    'photo' => $photo ? $photo : null,
                ]);
            }
        }

        return $this->sendResponse([], 'Campaign updated successfully');
    }

    public function galleryRemove($id)
    {
        $gallery = CampaignGallery::findOrFail($id);
        MediaHelper::handleDeleteImage($gallery->photo);
        $gallery->delete();
        return $this->sendResponse([], 'Gallery removed successfully');
    }

    public function delete(Request $request)
    {
        //return $this->sendResponse([], 'Campaign deleted successfully');
        $id = $request->id;
        $campaign = Campaign::whereUserId(auth()->id())->whereId($id)->first();
        MediaHelper::handleDeleteImage($campaign->photo);
        $gallery = CampaignGallery::where('campaign_id', $id)->get();
        foreach ($gallery as $item) {
            MediaHelper::handleDeleteImage($item->photo);
            $item->delete();
        }
        $faq = $campaign->faqs()->get();
        foreach ($faq as $item) {
            $item->delete();
        }

        // donation
        $donation = Donation::where("campaign_slug", $campaign->slug)->get();
        foreach ($donation as $item) {
            $item->delete();
        }

        $campaign->delete();
        return $this->sendResponse([], 'Campaign deleted successfully');
    }
}
