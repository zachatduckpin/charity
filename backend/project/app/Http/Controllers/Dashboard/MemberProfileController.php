<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\DashboardMemberProfile;
use Illuminate\View\View;

class MemberProfileController extends Controller
{
    public function __invoke(?string $member = null): View
    {
        $profiles = DashboardMemberProfile::query()
            ->where('status', 'active')
            ->orderBy('display_order')
            ->orderBy('organization_name');

        $profile = $member
            ? (clone $profiles)->where('slug', $member)->firstOrFail()
            : (clone $profiles)->firstOrFail();

        $relatedProfiles = DashboardMemberProfile::query()
            ->where('status', 'active')
            ->where('profile_type', $profile->profile_type)
            ->whereKeyNot($profile->getKey())
            ->orderBy('display_order')
            ->orderBy('organization_name')
            ->limit(6)
            ->get();

        return view('dashboard.member-profile.show', [
            'profile' => $profile,
            'relatedProfiles' => $relatedProfiles,
        ]);
    }
}
