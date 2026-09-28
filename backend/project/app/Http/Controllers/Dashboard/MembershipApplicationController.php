<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class MembershipApplicationController extends Controller
{
    public function __invoke(): View
    {
        return view('dashboard.membership-applications.index');
    }
}
