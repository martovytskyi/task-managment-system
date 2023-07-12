<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    /**
     * @param Request $request
     * @param $locale
     * @return RedirectResponse
     */
    public function setLocale(Request $request, $locale): RedirectResponse
    {
        $supportedLocales = config('app.supported_locales');

        if (array_key_exists($locale, $supportedLocales)) {
            if (array_key_exists($locale, config('app.supported_locales'))) {
                setcookie('locale', $locale, time() + (86400 * 30), '/');
                app()->setLocale($locale);
            }
        }

        return redirect()->back();
    }
}
