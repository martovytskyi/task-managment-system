<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\ServiceProvider;

class LocaleServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        $this->setLocaleFromCookie();
    }

    /**
     * @return void
     */
    private function setLocaleFromCookie(): void
    {
        $locale = Cookie::get('locale');

        if (request()->hasCookie('locale') && array_key_exists($locale, config('app.supported_locales'))) {
            $locale = request()->cookie('locale');
            App::setLocale($locale);
        } else {
            App::setLocale('ua');
        }
    }
}
