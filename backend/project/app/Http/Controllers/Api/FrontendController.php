<?php

namespace App\Http\Controllers\Api;

use App\Http\Helpers\MediaHelper;
use App\Models\About;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\Brand;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\ContactPage;
use App\Models\Counter;
use App\Models\Currency;
use App\Models\Donation;
use App\Models\Event;
use App\Models\Faq;
use App\Models\Feature;
use App\Models\Generalsetting;
use App\Models\Language;
use App\Models\Page;
use App\Models\Preloaded;
use App\Models\SeoSetting;
use App\Models\Subscriber;
use App\Models\Testimonial;
use App\Models\SocialLink;
use App\Models\Volunteer;
use Illuminate\Http\Request;


class FrontendController extends ApiController
{

    public function language($code)
    {
        $data['languages'] = Language::orderBy('id', 'DESC')->get();
        $default = Language::where('is_default', 1)->first();
        if (!$code) {
            $data['code'] = $default->code;
            $data['language'] = file_get_contents(base_path('resources/lang/' . $default->code . '.json'));
            return $this->sendResponse($data, 'Language Data');
        }
        $data['language'] = json_decode(file_get_contents(base_path('resources/lang/' . $code . '.json')));

        return $this->sendResponse($data, 'Language Data');
    }

    public function homeContent(Request $request)
    {
        $content = explode(',', $request->content);
        $content = array_filter($content);
        if (count($content) == 0) {
            $all = ['*'];
        } else {
            $all = $content;
        }

        if (in_array('about', $all) || in_array('*', $all)) {
            $about = About::first();
            $about['photo'] = asset('assets/images/' . $about->photo);
            $data['about'] = $about;
        }

        if (in_array('feature_campaign', $all) || in_array('*', $all)) {
            $data['feature_campaign'] = Campaign::with('category')
                ->where('status', 1)
                ->where('is_feature', 1)
                ->where(function ($query) {
                    $query->where('close_type', 'goal')
                        ->where('goal', '=>', 'raised');
                })
                ->orWhere(function ($query) {
                    $query->where('close_type', 'end_date')
                        ->whereDate('end_date', '>=', now()->toDateString());
                })
                ->get()
                ->map(function ($campaign) {
                    $campaign->formatted_created_at = dateFormat($campaign->created_at->format('Y-m-d'));
                    return $campaign;
                });
        }

        if (in_array('latest_category', $all) || in_array('*', $all)) {
            $data['latest_category'] = Category::where('status', 1)
                ->orderBy('id', 'desc')
                ->take(9)
                ->get();
        }

        if (in_array('brands', $all) || in_array('*', $all)) {
            $data['brands'] = Brand::orderBy('id', 'desc')
                ->get();
        }

        if (in_array('counters', $all) || in_array('*', $all)) {
            $data['counters'] = Counter::orderBy('id', 'desc')
                ->take(4)
                ->get();
        }

        if (in_array('faq', $all) || in_array('*', $all)) {
            $data['faqs'] = Faq::orderBy('id', 'desc')
                ->take(9)
                ->get();
        }

        if (in_array('testimonials', $all) || in_array('*', $all)) {
            $data['testimonials'] = Testimonial::orderBy('id', 'desc')->take(10)->get();
        }

        if (in_array('newest_campaign', $all) || in_array('*', $all)) {
            $data['newest_campaign'] = Campaign::with('category')
                ->where('status', 1)
                ->latest()
                ->take(9)
                ->get()
                ->map(function ($campaign) {
                    $campaign->formatted_created_at = dateFormat($campaign->created_at->format('Y-m-d'));
                    return $campaign;
                });
        }

        if (in_array('volunteers', $all) || in_array('*', $all)) {
            $data['volunteers'] = Volunteer::orderBy('id', 'desc')->whereStatus(1)->get()
                ->map(function ($volunteer) {
                    $volunteer->photo = asset('assets/images/' . $volunteer->photo);
                    return $volunteer;
                });
        }

        $gs = Generalsetting::first();


        if (in_array('recent_blogs', $all) || in_array('*', $all)) {
            if ($gs->theme == 'theme4') {
                $data['recent_blogs'] = Blog::orderBy('id', 'desc')->limit(4)->get()
                    ->map(function ($blog) {
                        $blog->formatted_created_at = dateFormat($blog->created_at);
                        return $blog;
                    });
            } else {
                $data['recent_blogs'] = Blog::orderBy('id', 'desc')->limit(3)->get()
                    ->map(function ($blog) {
                        $blog->formatted_created_at = dateFormat($blog->created_at);
                        return $blog;
                    });
            }
        }

        return $this->sendResponse($data, 'Home Content');
    }

    public function setting()
    {
        $hero_section = Generalsetting::first();
        $hero_section['header_logo'] = getPhoto($hero_section->header_logo);
        $hero_section['footer_logo'] = getPhoto($hero_section->footer_logo);
        $hero_section['breadcumb'] = getPhoto($hero_section->breadcumb);
        $hero_section['maintenance_photo'] = getPhoto($hero_section->maintenance_photo);
        $hero_section['hero_photo'] = getPhoto($hero_section->hero_photo);
        $hero_section['hero_photo2'] = getPhoto($hero_section->hero_photo2);
        $hero_section['hero_photo3'] = getPhoto($hero_section->hero_photo3);
        $hero_section['hero_photo4'] = getPhoto($hero_section->hero_photo4);
        $hero_section['footer_photo1'] = getPhoto($hero_section->footer_photo1);
        $hero_section['footer_photo2'] = getPhoto($hero_section->footer_photo2);
        $hero_section['cta_background_theme1'] = getPhoto($hero_section->cta_background_theme1);
        $hero_section['cta_background_theme2'] = getPhoto($hero_section->cta_background_theme2);
        $hero_section['cta_background_theme3_1'] = getPhoto($hero_section->cta_background_theme3_1);
        $hero_section['cta_background_theme3_2'] = getPhoto($hero_section->cta_background_theme3_2);

        $hero_section['cta_background_theme4_1'] = getPhoto($hero_section->cta_background_theme4_1);
        $hero_section['cta_background_theme4_2'] = getPhoto($hero_section->cta_background_theme4_2);

        $hero_section['checkout_success_photo'] = getPhoto($hero_section->checkout_success_photo);
        $hero_section['checkout_faild_photo'] = getPhoto($hero_section->checkout_faild_photo);
        $hero_section['counter_background'] = getPhoto($hero_section->counter_background);
        $hero_section['faq_theme1'] = getPhoto($hero_section->faq_theme1);
        $hero_section['faq_theme2'] = getPhoto($hero_section->faq_theme2);
        $hero_section['faq_theme3'] = getPhoto($hero_section->faq_theme3);
        $hero_section['faq_theme4'] = getPhoto($hero_section->faq_theme4);
        $hero_section['testimonial_background'] = getPhoto($hero_section->testimonial_background);
        $hero_section['volunteers_background'] = getPhoto($hero_section->volunteers_background);
        $hero_section['social_data'] = SocialLink::get();
        return $this->sendResponse($hero_section, 'Setting Data');
    }


    public function seoSetting()
    {
        $data = SeoSetting::first();
        $data['meta_image'] = getPhoto($data->meta_image);
        return $this->sendResponse($data, 'Setting Data');
    }

    public function getCategory()
    {
        $categories = Category::where('status', 1)->get();

        return $this->sendResponse($categories, 'Category Data');
    }

    public function getCampaign(Request $request)
    {
        $category = $request->category ? Category::where('slug', $request->category)->first()->id : null;
        $sortby = $request->sortby;
        $condition = $request->has('condition') ? $request->condition : null;
        $campaigns = Campaign::with(['category', "galleries"])
            ->when($category, function ($query, $category) {
                return $query->where('category_id', $category);
            })
            ->when($sortby, function ($query, $sortby) {
                if ($sortby == 'newest') {
                    return $query->orderBy('id', 'desc');
                } elseif ($sortby == 'oldest') {
                    return $query->orderBy('id', 'asc');
                }
            })
            ->when($condition, function ($query) {
                return $query->where('is_feature', 1);
            })
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->paginate(12);
        return $this->sendResponse($campaigns, 'Campaign Data');
    }

    public function singleCampaign($slug)
    {
        $campaign = Campaign::with(['category', 'faqs', 'galleries'])->where('slug', $slug)->first();

        if (!$campaign) {
            return $this->sendError('Campaign Not Found', 404);
        }

        if ($campaign) {
            foreach ($campaign->galleries as $gallery) {
                $gallery['original'] = $gallery->photo;
                $gallery['thumbnail'] = $gallery->photo;
                unset($gallery->photo);
                unset($gallery->id);
                unset($gallery->campaign_id);
            }
        }

        if ($campaign->user_id != null || $campaign->user_id != 0) {
            $campaign['author'] = $campaign->user->username;
        } else {
            $campaign['author'] = 'Admin';
        }

        $campaign['founded'] = dateFormat($campaign->founded);
        $data['campaign'] = $campaign;
        $data['preloaded'] = Preloaded::get();
        $data['related_campaigns'] = Campaign::with('category')->where('status', 1)->where('category_id', $campaign->category_id)->where('id', '!=', $campaign->id)->orderBy('id', 'desc')->limit(6)->get();
        return $this->sendResponse($data, 'Single Campaign');
    }

    public function getBlogs(Request $request)
    {

        $search = $request->search;
        $category = $request->category ? Category::where('slug', $request->category)->first()->id : null;
        $tag = $request->tag;

        $data['categories'] = BlogCategory::get();
        $data['blogs'] = Blog::with('category')->orderBy('id', 'desc')
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', '%' . $search . '%')->orWhere('sort_text', 'like', '%' . $search . '%');
            })
            ->when($category, function ($query, $category) {
                return $query->where('category_id', $category);
            })
            ->when($tag, function ($query, $tag) {
                return $query->where('tags', 'like', '%' . $tag . '%');
            })
            ->paginate(12);

        $data['recent_blogs'] = Blog::orderBy('id', 'desc')->limit(6)->get();
        return $this->sendResponse($data, 'Blog Data');
    }

    public function singleBlog($slug)
    {
        $blog = Blog::with('category')->where('slug', $slug)->first();
        $blog->views = $blog->views + 1;
        $blog->save();
        $data['blog'] = $blog;
        $data['recent_blogs'] = Blog::orderBy('id', 'desc')->limit(6)->get();
        $data['comments'] = BlogComment::where('blog_id', $data['blog']->id)->orderBy('id', 'desc')->get();
        return $this->sendResponse($data, 'Single Blog');
    }

    public function getPage()
    {
        $data['data'] = Page::get();
        return $this->sendResponse($data, 'Page Data');
    }

    public function page($slug)
    {
        $page = Page::where('slug', $slug)->first();
        return $this->sendResponse($page, 'Single Blog');
    }

    public function contactPage()
    {
        $page = ContactPage::first();
        return $this->sendResponse($page, 'Contact Page');
    }

    public function aboutPage()
    {
        $about = About::first();
        $about['photo'] = getPhoto($about->photo);
        $about['photo2'] = getPhoto($about->photo2);
        $about['photo3'] = getPhoto($about->photo3);
        $about['photo4'] = getPhoto($about->photo4);
        $about['backgroud_photo'] = getPhoto($about->backgroud_photo);
        $data['about'] = $about;
        $data['features'] = Feature::orderby('id')->get();
        $data['counters'] = Counter::orderby('id')->get();
        $data['brands'] = Brand::orderby('id')->get();
        return $this->sendResponse($data, 'Abount Page');
    }

    public function getCurrency()
    {
        $currency = Currency::whereStatus(1)->get();
        return $this->sendResponse($currency, 'Currency Data');
    }

    public function singleCurrency($currency_code)
    {
        $currency = Currency::whereStatus(1)->whereCode($currency_code)->first();
        return $this->sendResponse($currency, 'Single Currency Data');
    }

    public function newsletterSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);

        $exist = Subscriber::where('email', $request->email)->first();
        if ($exist) {
            return $this->sendError('Email Already Subscribed');
        }

        $newsletter = new Subscriber();
        $newsletter->email = $request->email;
        $newsletter->save();
        return $this->sendResponse($newsletter, 'Newsletter Subscribed');
    }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $contact = new ContactMessage();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save();
        return $this->sendResponse($contact, 'Message Sent');
    }

    public function blogCommentSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'comment' => 'required',
        ]);

        $comment = new BlogComment();
        $comment->blog_id = $request->blog_id;
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->comment = $request->comment;
        $comment->created_at = now();

        $comment->save();
        return $this->sendResponse($comment, 'Comment Submitted');
    }

    public function volunteerSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            "cv" => "required|mimes:pdf|max:5048",
        ]);

        $data = new Volunteer();
        $data->name = $request->name;
        $data->designation = $request->designation;
        $data->facebook = $request->facebook;
        $data->twitter = $request->twitter;
        $data->linkedin = $request->linkedin;
        $data->instagram = $request->instagram;
        if (isset($request['photo'])) {
            $status = MediaHelper::ExtensionValidation($request['photo']);
            if (!$status) {
                return $this->sendError('file format not supported');
            }
            $data->photo = MediaHelper::handleMakeImage($request['photo']);
        }
        if (isset($request['cv'])) {
            $status = MediaHelper::ExtensionValidation($request['cv']);
            if (!$status) {
                return $this->sendError('file format not supported');
            }
            $data->cv = MediaHelper::handleMakeFile($request['cv']);
        }
        $data->save();

        return $this->sendResponse($data, 'Volunteer Request Submitted Successfully ');
    }

    public function GetEvents(Request $request)
    {

        $search = $request->search;

        $data['events'] = Event::orderBy('id', 'desc')
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', '%' . $search . '%')->orWhere('description', 'like', '%' . $search . '%');
            })
            ->paginate(12);
        $data['recent_events'] = Event::orderBy('id', 'desc')->limit(4)->get();
        return $this->sendResponse($data, 'Event Fetch');
    }

    public function singleEvent($slug)
    {
        $data['event'] = Event::whereSlug($slug)->first();
        if ($data['event']) {
            return $this->sendResponse($data, 'Single Event Fetch');
        } else {
            return $this->sendError('Event Not Found', 404);
        }
    }

    public function getGallery()
    {
        $data['gallery'] = Campaign::whereIn('status', [1, 2])
            ->join('campaign_galleries', 'campaigns.id', '=', 'campaign_galleries.campaign_id')
            ->select('campaign_galleries.photo', 'campaign_galleries.campaign_id')
            ->paginate(15);

        return $this->sendResponse($data, 'Gellery Fetch');
    }

    public function getTestimonials()
    {
        $data = Testimonial::orderBy('id', 'desc')->paginate(16);
        return $this->sendResponse($data, 'Gellery Fetch');
    }

    public function donorList()
    {
        $donors = Donation::with(['campaign:id,title,slug,photo'])->where('status', 1)->orderBy('id', 'desc')->select(
            'name',
            'total',
            "campaign_slug",
            'created_at'
        )->paginate(16);
        return $this->sendResponse($donors, 'Donor List');
    }
    public function getFaq()
    {
        $data['faqs'] = Faq::orderBy('id', 'desc')->get();
        return $this->sendResponse($data, 'Faq List');
    }

    public function volunteerList()
    {
        $data['volunteers'] = Volunteer::orderBy('id', 'desc')->whereStatus(1)->paginate(16);
        return $this->sendResponse($data, 'Volunteer List');
    }
}
