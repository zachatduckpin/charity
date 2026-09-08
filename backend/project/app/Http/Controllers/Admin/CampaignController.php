<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\MediaHelper;
use App\Models\Campaign;
use App\Models\CampaignGallery;
use App\Models\Category;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CampaignController extends Controller
{
    public function index(Request $request)
    {

        $campaign = Campaign::all();
        foreach ($campaign as $camp) {
            if ($camp->close_type == 'goal') {
                if ($camp->raised >= $camp->goal) {
                    $camp->status = 2;
                    $camp->update();
                }
            } else {
                if ($camp->end_date < now()->toDateString()) {
                    $camp->status = 2;
                    $camp->update();
                }
            }
        }

        $search = $request->search;

        switch ($request->type) {
            case 'pending':
                $campaigns = Campaign::
                    where('status', 0)
                    ->when($search, function ($query, $search) {
                        return $query->where('title', 'like', '%' . $search . '%');
                    })
                    ->orderby('id', 'desc')
                    ->paginate(10);
                break;

            case 'running':
                $campaigns = Campaign::
                    where('status', 1)
                    ->when($search, function ($query, $search) {
                        return $query->where('title', 'like', '%' . $search . '%');
                    })
                    ->orderby('id', 'desc')
                    ->paginate(10);
                break;
            case 'closed':
                $campaigns = Campaign::
                    where('status', 2)
                    ->when($search, function ($query, $search) {
                        return $query->where('title', 'like', '%' . $search . '%');
                    })
                    ->orderby('id', 'desc')
                    ->paginate(10);
                break;

            default:
                $campaigns = Campaign::
                    orderby('id', 'desc')
                    ->when($search, function ($query, $search) {
                        return $query->where('title', 'like', '%' . $search . '%');
                    })
                    ->paginate(10);
                break;
        }

        return view('admin.campaign.index', compact('campaigns'));
    }

    public function create()
    {
        $categories = Category::get();
        return view('admin.campaign.create', compact('categories'));
    }

    public function store(Request $request)
    {
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
        $campaign->title = $request->title;
        $campaign->location = $request->location;
        $campaign->benefits = $request->benefits;
        $campaign->end_date = $request->end_date;
        $campaign->video_link = $request->video_link;
        $campaign->slug = Str::slug($request->title);
        $campaign->description = clean($request->description);
        $campaign->category_id = $request->category_id;
        $campaign->goal = adminStore($request->goal);
        $campaign->photo = MediaHelper::handleMakeImage($request->photo);
        $campaign->is_faq = $request->is_faq == 'on' ? 1 : 0;
        $campaign->is_preloaded = $request->is_preloaded == 'on' ? 1 : 0;
        $campaign->status = $request->status == 1 ? 1 : 0;
        $campaign->close_type = $request->close_type ?? 'goal';
        $campaign->save();

        if ($request->is_faq == 'on') {
            if ($request->faq_title && $request->faq_content) {
                foreach ($request->faq_title as $key => $question) {
                    $campaign->faqs()->create([
                        'title' => $question ? $question : null,
                        'content' => $request->faq_content[$key] ? $request->faq_content[$key] : null,
                    ]);
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
        }
        return redirect()->route('admin.campaign.index')->with('success', 'Campaign created successfully');
    }

    public function edit($id)
    {
        $data = Campaign::with(['galleries', 'faqs'])->findOrFail($id);
        $categories = Category::get();
        return view('admin.campaign.edit', compact('data', 'categories'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'title' => 'required|unique:campaigns,title,' . $id,
            'description' => 'required',
            'category_id' => 'required',
            'photo' => 'mimes:jpeg,jpg,png',
            'goal' => 'required',
            "location" => "required",
            "benefits" => "required|numeric",
            "end_date" => "required",

        ]);

        $campaign = Campaign::findOrFail($id);
        $campaign->title = $request->title;
        $campaign->slug = Str::slug($request->title);
        $campaign->description = clean($request->description);
        $campaign->category_id = $request->category_id;
        $campaign->goal = $request->goal;
        $campaign->location = $request->location;
        $campaign->benefits = $request->benefits;
        $campaign->end_date = $request->end_date;
        $campaign->video_link = $request->video_link;

        if ($request->photo) {
            $campaign->photo = MediaHelper::handleUpdateImage($request->photo, $campaign->photo);
        }

        $campaign->is_faq = $request->is_faq == 'on' ? 1 : 0;
        $campaign->is_preloaded = $request->is_preloaded == 'on' ? 1 : 0;
        $campaign->status = $request->status;
        $campaign->close_type = $request->close_type ?? 'goal';
        $campaign->update();

        if ($request->is_faq == 'on') {
            if ($request->faq_title && $request->faq_content) {
                if ($request->faq_title && $request->faq_content) {
                    $campaign->faqs()->delete();
                }

                foreach ($request->faq_title as $key => $question) {
                    $campaign->faqs()->create([
                        'title' => $question ? $question : null,
                        'content' => $request->faq_content[$key] ? $request->faq_content[$key] : null,
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

        return redirect()->route('admin.campaign.index')->with('success', 'Campaign updated successfully');
    }

    public function galleryRemove($id)
    {
        $gallery = CampaignGallery::findOrFail($id);
        MediaHelper::handleDeleteImage($gallery->photo);
        $gallery->delete();
        return response()->json(['success' => 'Gallery deleted successfully']);
    }

    public function status($id, $status, $type)
    {

        $campaign = Campaign::findOrFail($id);
        if ($type == 'status') {
            $campaign->status = $status;
        } else {
            $campaign->is_feature = $status;
        }

        $campaign->update();
        return redirect()->back()->with('success', 'Campaign status updated successfully');
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $campaign = Campaign::findOrFail($id);
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
        return redirect()->back()->with('success', 'Campaign deleted successfully');
    }
}
