<aside id="sidebar-wrapper">
    <ul class="sidebar-menu mb-5">
        <li class="menu-header">@lang('Dashboard')</li>


        <li class="nav-item {{ menu('admin.dashboard') }}">
            <a href="{{ route('admin.dashboard') }}" class="nav-link"><i
                    class="fas fa-fire"></i><span>@lang('Dashboard')</span></a>
        </li>

        @if (auth()->guard('admin')->user()->sectionCheck('Manage Donations'))
            <li class="nav-item {{ menu(['admin.donation.*']) }}">
                <a href="{{ route('admin.donation.index') }}" class="nav-link">
                    <i class="fas fa-envelope-open-text">
                    </i>
                    <span>@lang('Manage Donations')
                    </span>
                </a>
            </li>
        @endif


        @if (auth()->guard('admin')->user()->sectionCheck('Manage Events'))
            <li class="nav-item {{ menu(['admin.event.*']) }}">
                <a href="{{ route('admin.event.index') }}" class="nav-link">
                    <i class="fas fa-calendar-plus"></i>
                    <span>@lang('Manage Events')
                    </span>
                </a>
            </li>
        @endif
        @if (auth()->guard('admin')->user()->sectionCheck('Manage User'))
            <li class="nav-item {{ menu(['admin.user.index', 'admin.user.details']) }}">
                <a href="{{ route('admin.user.index') }}" class="nav-link">
                    <i class="fas fa-users">
                    </i>
                    <span>@lang('Manage User')
                    </span>
                </a>
            </li>
        @endif
        @if (auth()->guard('admin')->user()->sectionCheck('Manage Campaign'))
            <li
                class="nav-item dropdown {{ menu(['admin.category.index', 'admin.preloaded.index', 'admin.campaign.*']) }}">
                @php
                    $pending = \App\Models\Campaign::where('status', 0)->count();
                @endphp
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-bullhorn"></i>
                    <span>@lang('Manage Campaign')
                        @if ($pending > 0)
                            <small class="badge badge-danger mr-4">!</small>
                        @endif
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ menu('admin.category.index') }}"><a class="nav-link"
                            href="{{ route('admin.category.index') }}">@lang('Categories')</a>
                    </li>
                    <li class="{{ menu('admin.preloaded.index') }}"><a class="nav-link"
                            href="{{ route('admin.preloaded.index') }}">@lang('Preloaded Amount')</a>
                    </li>
                    <li class="{{ url()->full() == route('admin.campaign.index') ? 'active' : '' }}"><a
                            class="nav-link" href="{{ route('admin.campaign.index') }}">@lang('All Campaigns')</a>
                    </li>
                    <li class="{{ url()->full() == route('admin.campaign.index') . '?type=pending' ? 'active' : '' }}">
                        <a class="nav-link {{ $pending > 0 ? 'beep beep-sidebar' : '' }}"
                            href="{{ route('admin.campaign.index') . '?type=pending' }}">@lang('Pending Campaigns')</a>
                    </li>
                    <li class="{{ url()->full() == route('admin.campaign.index') . '?type=running' ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ route('admin.campaign.index') . '?type=running' }}">@lang('Running Campaigns')</a>
                    </li>
                    <li class="{{ url()->full() == route('admin.campaign.index') . '?type=closed' ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ route('admin.campaign.index') . '?type=closed' }}">@lang('Closed Campaigns')</a>
                    </li>
                </ul>
            </li>
        @endif
        @if (auth()->guard('admin')->user()->sectionCheck('Manage Contact'))
            <li class="nav-item dropdown {{ menu(['admin.contact*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-envelope-open-text"></i></i>
                    <span>@lang('Manage Contact')</span></a>
                <ul class="dropdown-menu">

                    <li class="{{ menu('admin.contact.message') }}"><a class="nav-link"
                            href="{{ route('admin.contact.message') }}">@lang('Contact Messages')</a>
                    </li>
                    <li class="{{ menu('admin.contact.setting.index') }}"><a class="nav-link"
                            href="{{ route('admin.contact.setting.index') }}">@lang('Contact Setting')</a></li>
                </ul>
            </li>
        @endif
        @if (auth()->guard('admin')->user()->sectionCheck('Gateways'))
            <li class="nav-item dropdown {{ menu(['admin.gateway*', 'admin.currency.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-money-check-alt"></i> <span>@lang('Payment Gateway')</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ menu('admin.currency.index') }}"><a class="nav-link"
                            href="{{ route('admin.currency.index') }}">@lang('Currency')</a></li>
                    <li class="{{ menu('admin.gateway') }}"><a class="nav-link"
                            href="{{ route('admin.gateway') }}">@lang('Gateways')</a>
                    </li>
                </ul>
            </li>
        @endif
        @if (auth()->guard('admin')->user()->sectionCheck('Manage Withdraw'))
            <li class="nav-item dropdown {{ menu(['admin.withdraw*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-hand-holding-usd"></i> <span>@lang('Manage Withdraw')</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ menu('admin.withdraw.settings') }}"><a class="nav-link"
                            href="{{ route('admin.withdraw.settings') }}">@lang('Withdraw Settings')</a></li>
                    <li class="{{ menu('admin.withdraw.request') }}"><a class="nav-link"
                            href="{{ route('admin.withdraw.request') }}">@lang('Withdraw Requests')</a>
                    </li>
                </ul>
            </li>
        @endif
        @if (auth()->guard('admin')->user()->sectionCheck('Blogs'))
            <li class="nav-item dropdown {{ menu(['admin.bcategory*', 'admin.blog*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fab fa-blogger-b"></i>
                    <span>@lang('Blogs')</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ menu('admin.bcategory.index') }}"><a class="nav-link"
                            href="{{ route('admin.bcategory.index') }}">@lang('Category')</a></li>
                    <li class="{{ menu('admin.blog.index') }}"><a class="nav-link"
                            href="{{ route('admin.blog.index') }}">@lang('Blogs')</a>
                    </li>
                    <li class="{{ menu('admin.blog.comment') }}"><a class="nav-link"
                            href="{{ route('admin.blog.comment') }}">@lang('Comments')</a>
                    </li>
                </ul>
            </li>
        @endif
        @if (auth()->guard('admin')->user()->sectionCheck('Manage Pages'))
            <li class="nav-item dropdown {{ menu(['admin.page*', 'admin.counter.index', 'admin.about.index']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-file-alt"></i>
                    <span>@lang('Manage Pages')</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ menu('admin.counter.index') }}"><a class="nav-link"
                            href="{{ route('admin.counter.index') }}">@lang('About Counter')</a>
                    </li>
                    <li class="{{ menu('admin.about.index') }}"><a class="nav-link"
                            href="{{ route('admin.about.index') }}">@lang('About Page')</a></li>
                    <li class="{{ menu('admin.page.index') }}"><a class="nav-link"
                            href="{{ route('admin.page.index') }}">@lang('Other Page')</a>
                    </li>
                </ul>
            </li>
        @endif
        @if (auth()->guard('admin')->user()->sectionCheck('Manage Volunteer'))
            <li class="nav-item dropdown {{ menu(['admin.volunteer.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i>
                    <span>@lang('Manage Volunteer')</span></a>
                <ul class="dropdown-menu">

                    <li class="{{ menu('admin.volunteer.index') }}"><a class="nav-link"
                            href="{{ route('admin.volunteer.index') }}">@lang('Manage Volunteer')</a></li>

                </ul>
            </li>
        @endif
        @if (auth()->guard('admin')->user()->sectionCheck('General Settings'))
            <li class="menu-header">@lang('General')</li>

            <li
                class="nav-item dropdown {{ menu(['admin.gs*', 'admin.mail.config', 'admin.social.manage*', 'admin.language*', 'admin.cookie', 'admin.checkout', 'admin.seo-setting.index']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-cog"></i><span>@lang('General Settings')</span></a>
                <ul class="dropdown-menu">

                    <li class="{{ menu('admin.gs.site.settings') }}"><a class="nav-link"
                            href="{{ route('admin.gs.site.settings') }}">@lang('Site Settings')</a>
                    </li>
                    <li class="{{ menu('admin.gs.theme.home.page') }}"><a class="nav-link"
                            href="{{ route('admin.gs.theme.home.page') }}">@lang('Home Page')</a>
                    </li>
                    <li class="{{ menu('admin.mail.config') }}"><a class="nav-link"
                            href="{{ route('admin.mail.config') }}">@lang('Email Config')</a>
                    </li>
                    <li class="{{ menu('admin.gs.logo') }}"><a class="nav-link"
                            href="{{ route('admin.gs.logo') }}">@lang('Logo')</a></li>
                    <li class="{{ menu('admin.gs.breadcumb') }}"><a class="nav-link"
                            href="{{ route('admin.gs.breadcumb') }}">@lang('Breadcumb')</a></li>
                    <li class="{{ menu('admin.language.index') }}"><a class="nav-link"
                            href="{{ route('admin.language.index') }}">@lang('Language')</a></li>

                    <li class="{{ menu('admin.social.manage') }}"><a class="nav-link"
                            href="{{ route('admin.social.manage') }}">@lang('Social Links')</a></li>

                    <li class="{{ menu('admin.checkout') }}"><a class="nav-link"
                            href="{{ route('admin.checkout') }}">@lang('Checkout Settings')</a></li>
                    <li class="{{ menu('admin.seo-setting.index') }}"><a class="nav-link"
                            href="{{ route('admin.seo-setting.index') }}">@lang('Seo Settings')</a></li>

                    <li class="{{ menu('admin.gs.maintainance.settings') }}"><a class="nav-link"
                            href="{{ route('admin.gs.maintainance.settings') }}">@lang('Maintenance')</a>
                    </li>
                </ul>
            </li>
        @endif
        @if (auth()->guard('admin')->user()->sectionCheck('Frontend Setting'))
            <li
                class="nav-item dropdown {{ menu(['admin.front*', 'admin.cta.index', 'admin.faq*', 'admin.testimonial*', 'admin.brand*', 'admin.contact.section', 'admin.slider*', 'admin.frontend*', 'admin.hero.index', 'admin.about.index', 'admin.footer.index']) }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i>
                    <span>@lang('Frontend Setting')</span></a>
                <ul class="dropdown-menu">

                    <li class="{{ menu('admin.hero.index') }}"><a class="nav-link"
                            href="{{ route('admin.hero.index') }}">@lang('Hero Section')</a></li>

                    <li class="{{ menu('admin.testimonial.index') }}"><a class="nav-link"
                            href="{{ route('admin.testimonial.index') }}">@lang('Testimonials')</a>
                    </li>

                    <li class="{{ menu('admin.cta.index') }}"><a class="nav-link"
                            href="{{ route('admin.cta.index') }}">@lang('CTA Section')</a>
                    </li>


                    <li class="{{ menu('admin.faq.index') }}"><a class="nav-link"
                            href="{{ route('admin.faq.index') }}">@lang('Manage Faq')</a>
                    </li>

                    <li class="{{ menu('admin.brand.index') }}"><a class="nav-link"
                            href="{{ route('admin.brand.index') }}">@lang('Brand')</a>
                    </li>
                    <li class="{{ menu('admin.footer.index') }}"><a class="nav-link"
                            href="{{ route('admin.footer.index') }}">@lang('Footer')</a>
                    </li>

                </ul>
            </li>
        @endif
        @if (auth()->guard('admin')->user()->sectionCheck('Support Tickets'))
            <li class="nav-item {{ menu('admin.ticket.manage') }}">
                <a href="{{ route('admin.ticket.manage') }}" class="nav-link"><i
                        class="fas fa-ticket-alt"></i><span>@lang('Support Tickets')</span></a>
            </li>
        @endif

        <li class="nav-item {{ menu('admin.subscriber.manage') }}">
            <a href="{{ route('admin.subscriber.manage') }}" class="nav-link">
                <i class="fas fa-envelope-open-text"></i>
                <span>@lang('Manage Subscribers')</span>
            </a>
        </li>



        @if (auth()->guard('admin')->user()->sectionCheck('Staff and Role'))
            <li class="menu-header">@lang('Staff and Role')</li>
            <li class="nav-item {{ menu('admin.role*') }}">
                <a href="{{ route('admin.role.index') }}" class="nav-link"><i
                        class="far fa-question-circle"></i><span>@lang('Manage Role')</span></a>
            </li>
        @endif
        @if (auth()->guard('admin')->user()->sectionCheck('Manage Staff'))
            <li class="nav-item {{ menu('admin.staff*') }}">
                <a href="{{ route('admin.staff.manage') }}" class="nav-link"><i
                        class="fas fa-user-shield"></i><span>@lang('Manage Staff')</span></a>
            </li>
        @endif

        <li class="nav-item {{ menu('admin.clear.cache') }}">
            <a href="{{ route('admin.clear.cache') }}" class="nav-link"><i class="fas fa-broom"></i>
                <span>@lang('Clear Cache')</span></a>
        </li>
    </ul>
</aside>
