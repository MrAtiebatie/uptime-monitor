<?php

namespace App\Console\Commands;

use App\Models\Site;
use App\Jobs\ScanSiteJob;
use Illuminate\Console\Command;

class ScanSites extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scan-sites';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scan all sites';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sites = Site::cursor();

        $sites->each(fn (Site $site) => dispatch(new ScanSiteJob($site)));

        $this->info("Scanned {$sites->count()} sites");

        return Command::SUCCESS;
    }
}
