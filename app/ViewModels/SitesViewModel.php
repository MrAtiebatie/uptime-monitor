<?php

namespace App\ViewModels;

use App\Models\Site;
use Illuminate\Http\Request;
use Spatie\ViewModels\ViewModel;
use App\Http\Resources\SiteResource;

class SitesViewModel extends ViewModel
{
    public function __construct(private Request $request)
    {
        //
    }

    public function sites()
    {
        $sites = Site::whereTeamId($this->request->user()->current_team_id)
            ->with('last_scan_result')
            ->get();

        $sites->transform(fn (Site $site) => new SiteResource($site));

        return $sites;
    }
}
