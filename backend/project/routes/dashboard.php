<?php

use App\Http\Controllers\Dashboard\CampaignController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DonationController;
use App\Http\Controllers\Dashboard\EventController;
use App\Http\Controllers\Dashboard\MemberController;
use App\Http\Controllers\Dashboard\MemberProfileController;
use App\Http\Controllers\Dashboard\MembershipApplicationController;
use App\Http\Controllers\Dashboard\WorkspaceController;
use Illuminate\Support\Facades\Route;

Route::prefix('dashboard')
    ->name('dashboard.')
    ->middleware(['auth:admin', 'can:dashboard.view'])
    ->group(function (): void {
        Route::get('/', DashboardController::class)->name('index');
        Route::get('/campaigns', CampaignController::class)
            ->middleware('can:campaigns.view')
            ->name('campaigns.index');
        Route::get('/donations', DonationController::class)
            ->middleware('can:donations.view')
            ->name('donations.index');
        Route::get('/events', EventController::class)
            ->middleware('can:events.view')
            ->name('events.index');
        Route::get('/members', [MemberController::class, 'index'])
            ->middleware('can:members.view')
            ->name('members.index');
        Route::get('/members/create', [MemberController::class, 'create'])
            ->middleware('can:members.create')
            ->name('members.create');
        Route::post('/members', [MemberController::class, 'store'])
            ->middleware('can:members.create')
            ->name('members.store');
        Route::get('/members/{member}/edit', [MemberController::class, 'edit'])
            ->middleware('can:members.update')
            ->name('members.edit');
        Route::match(['put', 'patch'], '/members/{member}', [MemberController::class, 'update'])
            ->middleware('can:members.update')
            ->name('members.update');
        Route::delete('/members/{member}', [MemberController::class, 'destroy'])
            ->middleware('can:members.delete')
            ->name('members.destroy');
        Route::get('/membership-applications', MembershipApplicationController::class)
            ->middleware('can:membership-applications.view')
            ->name('membership-applications.index');
        Route::get('/member-leadership', function (WorkspaceController $controller) {
            return $controller->show('member-leadership');
        })->middleware('can:member-leadership.view')->name('member-leadership.index');
        Route::get('/member-profile/{member?}', MemberProfileController::class)
            ->middleware('can:member-profile.view')
            ->name('member-profile.show');
        Route::get('/member-operations', function (WorkspaceController $controller) {
            return $controller->show('member-operations');
        })->middleware('can:member-operations.view')->name('member-operations.index');
        Route::get('/membership-options', function (WorkspaceController $controller) {
            return $controller->show('membership-options');
        })->middleware('can:membership-options.view')->name('membership-options.index');
        Route::get('/handbook', function (WorkspaceController $controller) {
            return $controller->show('handbook');
        })->middleware('can:handbook.view')->name('handbook.index');
        Route::get('/video-library', function (WorkspaceController $controller) {
            return $controller->show('video-library');
        })->middleware('can:video-library.view')->name('video-library.index');
        Route::get('/resource-centre', function (WorkspaceController $controller) {
            return $controller->show('resource-centre');
        })->middleware('can:resource-centre.view')->name('resource-centre.index');
        Route::get('/accreditation', function (WorkspaceController $controller) {
            return $controller->show('accreditation');
        })->middleware('can:accreditation.view')->name('accreditation.index');
        Route::get('/accreditation/application', function (WorkspaceController $controller) {
            return $controller->show('accreditation-application');
        })->middleware('can:accreditation-application.view')->name('accreditation-application.index');
        Route::get('/accreditation/workspace', function (WorkspaceController $controller) {
            return $controller->show('accreditation-workspace');
        })->middleware('can:accreditation-workspace.view')->name('accreditation-workspace.index');
        Route::get('/accreditation/reviewer-training', function (WorkspaceController $controller) {
            return $controller->show('accreditation-reviewer-training');
        })->middleware('can:accreditation-reviewer-training.view')->name('accreditation-reviewer-training.index');
        Route::get('/priority-queue', function (WorkspaceController $controller) {
            return $controller->show('priority-queue');
        })->middleware('can:priority-queue.view')->name('priority-queue.index');
        Route::get('/engagement', function (WorkspaceController $controller) {
            return $controller->show('engagement');
        })->middleware('can:engagement.view')->name('engagement.index');
        Route::get('/authority-levels', function (WorkspaceController $controller) {
            return $controller->show('authority-levels');
        })->middleware('can:authority-levels.view')->name('authority-levels.index');
    });
