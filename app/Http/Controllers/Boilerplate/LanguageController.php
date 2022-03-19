<?php

namespace App\Http\Controllers\Boilerplate;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class LanguageController extends Controller
{
    /**
     * Switch language.
     *
     * @param $lang
     * @return RedirectResponse
     */
    public function switch($lang): RedirectResponse
    {
        if (in_array($lang, config('boilerplate.locale.allowed'))) {
            setting(['locale' => $lang]);

            return Redirect::back()->withCookie(cookie()->forever('boilerplate_lang', $lang));
        }

        return Redirect::back();
    }
}
