<?php

namespace App\Providers;

use App\Composers\PayConfigurationComposer;
use App\Composers\SeoTags;
use App\Composers\ShareLinksComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    protected $composers = [
        SeoTags::class => ['layouts.app'],
        ShareLinksComposer::class => ['*'],
        PayConfigurationComposer::class => ['*']
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        foreach ($this->composers as $composer => $templates) {
            View::composer($templates, $composer);
        }
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }
}
