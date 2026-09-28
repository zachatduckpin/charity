<?php

namespace App\Http\Controllers\Api;

use App\Models\DashboardMemberProfile;

class DirectoryMemberController extends ApiController
{
    public function index()
    {
        $members = DashboardMemberProfile::query()
            ->directoryMembers()
            ->get()
            ->map(fn (DashboardMemberProfile $member): array => $member->toDirectoryPayload())
            ->values();

        return $this->sendResponse([
            'members' => $members,
            'updated_at' => now()->toIso8601String(),
        ]);
    }
}
