<?php

namespace App\Jobs;

use App\Models\Site;
use App\Models\ScanResult;
use Illuminate\Bus\Queueable;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;

class ScanSiteJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private Site $site)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $host = 'http://selenium:4444';
        $options = (new ChromeOptions())->addArguments(['--disable-gpu', '--headless']);

        $driver = RemoteWebDriver::create(
            $host,
            DesiredCapabilities::chrome()->setCapability(
                ChromeOptions::CAPABILITY,
                $options
            )
        );

        try {
            $driver->get($this->site->url);

            $source = $driver->getPageSource();
            $screenshot = $driver->takeScreenshot();

            ScanResult::create([
                'site_id' => $this->site->id,
                'query_found' => str_contains($source, $this->site->search_query),
                'response_body' => $source,
                'screenshot_data' => base64_encode($screenshot),
            ]);
        } catch (\Exception $e) {
            logs()->error($e->getMessage(), [$e]);
        } finally {
            $driver->quit();
        }
    }
}
