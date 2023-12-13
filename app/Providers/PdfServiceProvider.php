<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;
use Mpdf\Mpdf;

class PdfServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(Mpdf::class, function () {
            $default = (new ConfigVariables)->getDefaults();
            $defaultFontConfig = (new FontVariables)->getDefaults();

            config([
                'pdf.fontDir'  => array_merge(config('pdf.fontDir', []), $default['fontDir']),
                'pdf.fontdata' => array_merge(config('pdf.fontdata', []), $defaultFontConfig['fontdata'])
            ]);

            return new Mpdf(config('pdf'));
        });
    }
}
