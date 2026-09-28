<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Support\Dashboard\GnCentralCatalog;
use Illuminate\View\View;

class WorkspaceController extends Controller
{
    public function show(string $page): View
    {
        $pages = [
            'member-leadership',
            'member-operations',
            'membership-options',
            'handbook',
            'video-library',
            'resource-centre',
            'accreditation',
            'accreditation-application',
            'accreditation-workspace',
            'accreditation-reviewer-training',
            'priority-queue',
            'engagement',
            'authority-levels',
        ];

        abort_unless(in_array($page, $pages, true), 404);

        return view('dashboard.workspace', [
            'page' => GnCentralCatalog::workspace($page),
        ]);
    }
}
