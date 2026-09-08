<footer>
    <div class="footer-area footer-bg" style="background-image:url({{ asset('assets/admin/footer_bg.jpg') }}) ">
        <div class="footer-top">
            <div class="container">
                <div class="footer-logo-area">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <div class="logo">
                                <a href="{{route('front.index')}}"><img src="{{ getPhoto($gs->footer_logo) }}" alt=""></a>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="footer-social-menu">
                                <ul class="list-wrap">
                                    @foreach (DB::table('social_links')->get() as $social)
                                        <li><a href="{{ $social->link }}">{{ $social->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="footer-widget">
                            <div class="fw-title">
                                <h4 class="title">@lang('Contact Us')</h4>
                            </div>
                            <div class="footer-content">
                                <p>{{ $gs->address }}</p>
                                <div class="footer-contact">
                                    <ul class="list-wrap">
                                        <li class="phone-addess">
                                            <i class="fas fa-phone-alt"></i>
                                            <a href="tel:{{ $gs->phone }}">{{ $gs->phone }}</a>
                                        </li>
                                        <li class="email-addess"><a
                                                href="mailto:{{ $gs->email }}">{{ $gs->email }}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="footer-widget">
                            <div class="fw-title">
                                <h4 class="title">@lang('Our Links')</h4>
                            </div>
                            <div class="fw-link-list">
                                <ul class="list-wrap">
                                    <li><a href="{{ route('front.index') }}">@lang('Home')</a></li>
                                    <li><a href="{{ route('front.service') }}">@lang('Services')</a></li>
                                    <li><a href="{{ route('front.project') }}">@lang('Projects')</a></li>
                                    <li><a href="{{ route('front.blog') }}">@lang('Blog')</a></li>
                                    <li><a href="{{ route('front.contact') }}">@lang('Contacts')</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="footer-widget">
                            <div class="fw-title">
                                <h4 class="title">@lang('Our Services')</h4>
                            </div>
                            <div class="fw-link-list">
                                <ul class="list-wrap">
                                    @foreach (DB::table('services')->whereStatus(1)->orderby('id', 'desc')->take(6)->get() as $service)
                                        <li><a href="{{ route('front.service.details', $service->slug) }}">{{ $service->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="footer-widget">
                            <div class="fw-title">
                                <h4 class="title">@lang('Newsletter')</h4>
                            </div>
                            <div class="footer-newsletter">
                                <p>@lang('Subscribe our newsletter to get our latest update & news')</p>
                                <form action="{{ route('front.subscriber.submit') }}" method="POST">
                                    @csrf
                                    <input type="email" name="email" placeholder="{{ __('Your mail address') }}">
                                    <button type="submit" class="btn">@lang('Subscribe')</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="copyright-text">
                            <p>{{ $gs->copyright_text }}</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="footer-bottom-menu">
                            <ul class="list-wrap">
                                @foreach (DB::table('pages')->get() as $page)
                                    <li><a href="{{ route('front.page', $page->slug) }}">{{ $page->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
@if (isset($visited))
    @if ($gs->is_cookie == 1)
        <div class="cookie-bar-wrap show">
            <div class="container d-flex justify-content-center">
                <div class="col-xl-10 col-lg-12">
                    <div class="row justify-content-center">
                        <div class="cookie-bar">
                            <div class="cookie-bar-text">
                                {{ $gs->cookie_text }}
                            </div>
                            <div class="cookie-bar-action">
                                <button class="btn btn-primary btn-accept">
                                    {{ $gs->cookie_btn_text }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif

