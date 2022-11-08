<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;
use App\ViewModels\SitesViewModel;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $sites = new SitesViewModel($request);

        return inertia('Dashboard/Dashboard', $sites);
    }
}
