<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CounterController;
use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Admin\EmailController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\GeneralSettingController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ManageCurrencyController;
use App\Http\Controllers\Admin\ManageRoleController;
use App\Http\Controllers\Admin\ManageStaffController;
use App\Http\Controllers\Admin\ManageTestimonialController;
use App\Http\Controllers\Admin\ManageTicketController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PaymentGatewayController;
use App\Http\Controllers\Admin\PreloadedController;
use App\Http\Controllers\Admin\SeoSettingController;
use App\Http\Controllers\Admin\SocialController;
use App\Http\Controllers\Admin\VolunteerController;
use App\Http\Controllers\Admin\WithdrawController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/forgot-password', [LoginController::class, 'forgotPasswordForm'])->name('forgot.password');
    Route::post('/forgot-password', [LoginController::class, 'forgotPasswordSubmit']);
    Route::get('forgot-password/verify-code', [LoginController::class, 'verifyCode'])->name('verify.code');
    Route::post('forgot-password/verify-code', [LoginController::class, 'verifyCodeSubmit']);
    Route::get('reset-password', [LoginController::class, 'resetPassword'])->name('reset.password');
    Route::post('reset-password', [LoginController::class, 'resetPasswordSubmit']);

    Route::middleware(['auth:admin', "api-check"])->group(function () {
        Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
        Route::post('/profile/update', [AdminController::class, 'profileupdate'])->name('profile.update');
        Route::get('/password', [AdminController::class, 'passwordreset'])->name('password');
        Route::post('/password/update', [AdminController::class, 'changepass'])->name('password.update');

        Route::middleware(['license'])->group(function () {

            Route::group(['middleware' => 'permission:Manage Campaign'], function () {
                // category
                Route::get('category', [CategoryController::class, 'index'])->name('category.index');
                Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');
                Route::put('category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
                Route::delete('category/destroy', [CategoryController::class, 'destroy'])->name('category.destroy');

                // Preloaded

                Route::get('preloaded', [PreloadedController::class, 'index'])->name('preloaded.index');
                Route::post('preloaded/store', [PreloadedController::class, 'store'])->name('preloaded.store');
                Route::put('preloaded/update/{id}', [PreloadedController::class, 'update'])->name('preloaded.update');
                Route::delete('preloaded/destroy', [PreloadedController::class, 'destroy'])->name('preloaded.destroy');

                // campaign
                Route::get('campaign', [CampaignController::class, 'index'])->name('campaign.index');
                Route::get('campaign/create', [CampaignController::class, 'create'])->name('campaign.create');
                Route::post('campaign/store', [CampaignController::class, 'store'])->name('campaign.store');
                Route::get('campaign/edit/{campaign}', [CampaignController::class, 'edit'])->name('campaign.edit');
                Route::put('campaign/update/{campaign}', [CampaignController::class, 'update'])->name('campaign.update');
                Route::get('campaign/status/{id}/{status}/{type}', [CampaignController::class, 'status'])->name('campaign.status');
                Route::delete('campaign-delete', [CampaignController::class, 'destroy'])->name('campaign.destroy');
                Route::get('campaign/gallery/remove/{id}', [CampaignController::class, 'galleryRemove'])->name('campaign.gallery.remove');
            });

            Route::group(['middleware' => 'permission:Manage User'], function () {
                //==================================== USER SECTION  ==============================================//
                Route::get('manage-users', [ManageUserController::class, 'index'])->name('user.index');
                Route::get('user-details/{id}', [ManageUserController::class, 'details'])->name('user.details');
                Route::post('user-profile/update/{id}', [ManageUserController::class, 'profileUpdate'])->name('user.profile.update');
            });

            Route::group(['middleware' => 'permission:Manage Donations'], function () {
                // Donation
                Route::get('donation', [DonationController::class, 'index'])->name('donation.index');
                Route::get('donation/status/{id}/{status}', [DonationController::class, 'status'])->name('donation.status');
                Route::delete('donation/destroy', [DonationController::class, 'destroy'])->name('donation.destroy');
            });

            Route::group(['middleware' => 'permission:Manage Gateway'], function () {
                // Currency
                Route::get('/manage-currency', [ManageCurrencyController::class, 'index'])->name('currency.index');
                Route::get('/add-currency', [ManageCurrencyController::class, 'addCurrency'])->name('currency.add');
                Route::post('/add/currency/store', [ManageCurrencyController::class, 'store'])->name('currency.store');
                Route::get('/edit-currency/{id}', [ManageCurrencyController::class, 'editCurrency'])->name('currency.edit');
                Route::put('/update-currency/{id}', [ManageCurrencyController::class, 'updateCurrency'])->name('currency.update');
                Route::get('/currency/set-default/{id}', [ManageCurrencyController::class, 'setDefault'])->name('currency.default');
                Route::delete('/delete-currency', [ManageCurrencyController::class, 'deleteCurrency'])->name('currency.delete');

                Route::get('/payment-gateways', [PaymentGatewayController::class, 'index'])->name('gateway');
                Route::get('add/payment-gateway', [PaymentGatewayController::class, 'create'])->name('gateway.create');
                Route::post('/store/payment-gateway', [PaymentGatewayController::class, 'store'])->name('gateway.store');
                Route::get('/payment-gateway/edit/{paymentgateway}', [PaymentGatewayController::class, 'edit'])->name('gateway.edit');
                Route::post('/payment-gateway/update/{gateway}', [PaymentGatewayController::class, 'update'])->name('gateway.update');

            });

            Route::group(['middleware' => 'permission:Support Tickets'], function () {
                //support ticket
                Route::get('manage/tickets', [ManageTicketController::class, 'index'])->name('ticket.manage')->middleware('permission:manage ticket');
                Route::post('reply/ticket/{ticket_num}', [ManageTicketController::class, 'replyTicket'])->name('ticket.reply')->middleware('permission:manage ticket')->middleware('permission:reply ticket');

            });

            Route::group(['middleware' => 'permission:Manage Pages'], function () {
                //pages
                Route::get('page', [PageController::class, 'index'])->name('page.index');
                Route::get('page/create', [PageController::class, 'create'])->name('page.create');
                Route::post('page/store', [PageController::class, 'store'])->name('page.store');
                Route::get('page/edit/{page}', [PageController::class, 'edit'])->name('page.edit');
                Route::put('page/update/{page}', [PageController::class, 'update'])->name('page.update');
                Route::post('page/remove', [PageController::class, 'destroy'])->name('page.remove');

                // counter section
                Route::get('counter', [CounterController::class, 'index'])->name('counter.index');
                Route::post('counter/store', [CounterController::class, 'store'])->name('counter.store');
                Route::put('counter/update/{counter}', [CounterController::class, 'update'])->name('counter.update');
                Route::delete('counter-delete', [CounterController::class, 'destroy'])->name('counter.destroy');

            });

            Route::group(['middleware' => 'permission:Manage Events'], function () {
                //manage event
                Route::get('event', [EventController::class, 'index'])->name('event.index');
                Route::get('event/create', [EventController::class, 'create'])->name('event.create');
                Route::post('event/store', [EventController::class, 'store'])->name('event.store');
                Route::get('event/edit/{event}', [EventController::class, 'edit'])->name('event.edit');
                Route::put('event/update/{event}', [EventController::class, 'update'])->name('event.update');
                Route::delete('event/delete', [EventController::class, 'destroy'])->name('event.destroy');
            });

            Route::group(['middleware' => 'permission:Blogs'], function () {
                //manage blogs
                Route::get('blog-category', [BlogCategoryController::class, 'index'])->name('bcategory.index');
                Route::post('blog-category/store', [BlogCategoryController::class, 'store'])->name('bcategory.store');
                Route::put('blog-category/update/{id}', [BlogCategoryController::class, 'update'])->name('bcategory.update');
                Route::delete('blog-category/destroy', [BlogCategoryController::class, 'destroy'])->name('bcategory.destroy');

                Route::get('blog', [BlogController::class, 'index'])->name('blog.index');
                Route::get('blog/create', [BlogController::class, 'create'])->name('blog.create');
                Route::post('blog/store', [BlogController::class, 'store'])->name('blog.store');
                Route::get('blog/edit/{blog}', [BlogController::class, 'edit'])->name('blog.edit');
                Route::put('blog/update/{blog}', [BlogController::class, 'update'])->name('blog.update');
                Route::delete('blog-delete/{blog}', [BlogController::class, 'destroy'])->name('blog.destroy');

                // Comment
                Route::get('blog/comment', [BlogController::class, 'comment'])->name('blog.comment');
                Route::delete('blog/comment/delete/{comment}', [BlogController::class, 'commentDelete'])->name('blog.comment.delete');
            });

            Route::group(['middleware' => 'permission:Manage Volunteer'], function () {
                // manage team
                Route::get('/volunteer/background', [VolunteerController::class, 'background'])->name('volunteer.background');
                Route::get('/volunteer', [VolunteerController::class, 'index'])->name('volunteer.index');
                Route::get('/create-volunteer', [VolunteerController::class, 'create'])->name('volunteer.create');
                Route::post('/store-volunteer', [VolunteerController::class, 'store'])->name('volunteer.store');
                Route::get('/edit-volunteer/{id}', [VolunteerController::class, 'edit'])->name('volunteer.edit');
                Route::put('/update-volunteer/{id}', [VolunteerController::class, 'update'])->name('volunteer.update');
                Route::get('/update-status/{id}/{status}', [VolunteerController::class, 'status'])->name('volunteer.status');
                Route::delete('/volunteer/delete/volunteer', [VolunteerController::class, 'destroy'])->name('volunteer.destroy');
            });

            Route::group(['middleware' => 'permission:Frontend Setting'], function () {
                // HERO SECTION

                Route::get('/hero', [GeneralSettingController::class, 'hero'])->name('hero.index');
                Route::post('/hero/store', [GeneralSettingController::class, 'heroStore'])->name('hero.store');
                Route::get('/cta/section', [GeneralSettingController::class, 'ctaSection'])->name('cta.index');
                Route::post('/cta/section/update', [GeneralSettingController::class, 'ctaSectionUpdate'])->name('cta.section.update');

                Route::get('home/page/sections', [GeneralSettingController::class, 'homeSections'])->name('home.sections');
                Route::post('home/page/sections/update', [GeneralSettingController::class, 'homeSectionUpdate'])->name('home.sections.update');

                // About section
                Route::get('about', [AboutController::class, 'index'])->name('about.index');
                Route::put('about/update', [AboutController::class, 'update'])->name('about.update');
                // About Section feature
                Route::post('/feature/store', [FeatureController::class, 'store'])->name('feature.store');
                Route::put('/feature/update/{id}', [FeatureController::class, 'update'])->name('feature.update');
                Route::delete('/feature/delete', [FeatureController::class, 'destroy'])->name('feature.destroy');

                // brand section
                Route::get('/brands', [BrandController::class, 'index'])->name('brand.index');
                Route::post('/brand/store', [BrandController::class, 'store'])->name('brand.store');
                Route::put('/brand/update/{id}', [BrandController::class, 'update'])->name('brand.update');
                Route::delete('/brand/delete', [BrandController::class, 'destroy'])->name('brand.destroy');

                // Contact section
                Route::get('contact/section', [GeneralSettingController::class, 'contact_section'])->name('contact.section');
                // manage testimonail
                Route::get('/manage-testimonial', [ManageTestimonialController::class, 'index'])->name('testimonial.index');
                Route::post('/add-testimonial', [ManageTestimonialController::class, 'store'])->name('testimonial.store');
                Route::put('/update-testimonial/{id}', [ManageTestimonialController::class, 'update'])->name('testimonial.update');
                Route::delete('/delete-testimonial', [ManageTestimonialController::class, 'destroy'])->name('testimonial.destroy');

                // FAQ
                Route::get('faq', [FaqController::class, 'index'])->name('faq.index');
                Route::post('faq/store', [FaqController::class, 'store'])->name('faq.store');
                Route::put('faq/update/{id}', [FaqController::class, 'update'])->name('faq.update');
                Route::delete('faq/destroy', [FaqController::class, 'destroy'])->name('faq.destroy');
                Route::get("faq/images", [FaqController::class, 'faqImage'])->name('faq.image');


                  Route::get('/footer', [GeneralSettingController::class, 'footer'])->name('footer.index');

            });

            Route::group(['middleware' => 'permission:General Settings'], function () {
                //==================================== GENERAL SETTING SECTION ==============================================//

                Route::get('/general-settings', [GeneralSettingController::class, 'siteSettings'])->name('gs.site.settings');
                Route::get('/plugin-settings', [GeneralSettingController::class, 'pluginSettings'])->name('gs.plugin.settings');
                Route::get('/maintainance-settings', [GeneralSettingController::class, 'maintainance'])->name('gs.maintainance.settings');
                Route::post('/general-settings/update', [GeneralSettingController::class, 'update'])->name('gs.update');
                Route::get('/general-settings/logo-favicon', [GeneralSettingController::class, 'logo'])->name('gs.logo');
                Route::get('/general-settings/breadcumb', [GeneralSettingController::class, 'breadcumb'])->name('gs.breadcumb');
                Route::get('/general-settings/maintenance', [GeneralSettingController::class, 'maintenance'])->name('gs.maintenance');
                Route::get('/general-settings/status/update/{value}', [GeneralSettingController::class, 'StatusUpdate'])->name('gs.status');
                Route::get('/manage-checkout', [GeneralSettingController::class, 'checkout'])->name('checkout');
                Route::get('/email-config', [EmailController::class, 'config'])->name('mail.config');
                Route::post('/language/update', [AdminController::class, 'languageUpdate'])->name('language.update');
                Route::get('social/link', [SocialController::class, 'index'])->name('social.manage');
                Route::post('add/social/link', [SocialController::class, 'store'])->name('social.store');
                Route::put('update/social/link/{id}', [SocialController::class, 'update'])->name('social.update');
                Route::delete('destroy/social/link', [SocialController::class, 'destroy'])->name('social.destroy');
                // theme
                Route::get('/home-page', [GeneralSettingController::class, 'themeSettings'])->name('gs.theme.home.page');
                //==================================== GENERAL SETTING SECTION ==============================================//
                Route::resource('seo-setting', SeoSettingController::class);

                Route::resource('language', LanguageController::class);
                Route::post('add-translate/{id}', [LanguageController::class, 'storeTranslate'])->name('translate.store');
                Route::post('update-translate/{id}', [LanguageController::class, 'updateTranslate'])->name('translate.update');
                Route::post('remove-translate', [LanguageController::class, 'removeTranslate'])->name('translate.remove');
                Route::post('language/status-update', [LanguageController::class, 'statusUpdate'])->name('update-status.language');
                Route::post('language/remove', [LanguageController::class, 'destroy'])->name('remove.language');

            });

            Route::group(['middleware' => 'permission:Manage Withdraw'], function () {
                // ==================================== WITHDRAW SECTION ====================================//
                Route::get('/withdraw/settings', [WithdrawController::class, 'index'])->name('withdraw.settings');
                Route::get('/withdraw/request', [WithdrawController::class, 'withdrawRequest'])->name('withdraw.request');
                Route::get('/withdraw/approve/{id}', [WithdrawController::class, 'withdrawApprove'])->name('withdraw.approve');
                Route::get('/withdraw/reject/{id}', [WithdrawController::class, 'withdrawReject'])->name('withdraw.reject');
            });

            Route::group(['middleware' => 'permission:Manage Contact'], function () {
                // ==================================== ADMIN CONTACT SECTION ====================================//
                Route::get('/contact/page/setting', [ContactController::class, 'index'])->name('contact.setting.index');
                Route::put('/contact/page/setting/update', [ContactController::class, 'update'])->name('contact.setting.update');
                Route::get('/contact/message', [ContactController::class, 'contactMessage'])->name('contact.message');
                Route::get('/getintouch/message', [ContactController::class, 'getintouch'])->name('contact.getintouch.message');
                Route::delete('/contact/message/delete', [ContactController::class, 'contactMessageDelete'])->name('contact.message.delete');
            });

            Route::group(['middleware' => 'permission:Manage Role'], function () {
                //role manage
                Route::get('/role', [ManageRoleController::class, 'index'])->name('role.index');
                Route::get('/role/create', [ManageRoleController::class, 'create'])->name('role.create');
                Route::post('/role/store', [ManageRoleController::class, 'store'])->name('role.store');
                Route::get('/role/edit/{id}', [ManageRoleController::class, 'edit'])->name('role.edit');
                Route::put('/role/update/{id}', [ManageRoleController::class, 'update'])->name('role.update');
                Route::delete('/role/delete', [ManageRoleController::class, 'destroy'])->name('role.destroy');
            });

            Route::group(['middleware' => 'permission:Manage Staff'], function () {
                //manage staff

                Route::get('manage/staff', [ManageStaffController::class, 'index'])->name('staff.manage');
                Route::post('add/staff', [ManageStaffController::class, 'addStaff'])->name('staff.add');
                Route::post('update/staff/{id}', [ManageStaffController::class, 'updateStaff'])->name('staff.update');
                Route::delete('destroy/staff', [ManageStaffController::class, 'destroy'])->name('staff.destroy');
            });

            Route::get('/subscribers', [AdminController::class, 'subscribers'])->name('subscriber.manage');
            Route::delete('/subscribers/delete', [AdminController::class, 'subscribersDelete'])->name('subscriber.destroy');

        });

        Route::get('/clear-cache', function () {
            Artisan::call('optimize:clear');
            return back()->with('success', 'Cache cleared successfully');
        })->name('clear.cache');
    });
});

Route::get('/activation', [AdminController::class, 'activation'])->name('admin-activation-form');
Route::post('/activation', [AdminController::class, 'activation_submit'])->name('admin-activate-purchase');
Route::get('/import/addon', [AdminController::class, 'importAddon'])->name('admin-import-addon');
Route::post('/import/addon', [AdminController::class, 'importAddonSubmit'])->name('admin-import-addon-submit');
