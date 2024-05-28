<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class LanguageController extends Controller
{
    public function switchLang($locale)
    {
        if (array_key_exists($locale, config('app.languages'))) {
            Session::put('locale', $locale);
        }
        return redirect()->back();
    }

    public function selectLang(): View
    {
        return view('clients.languageSelect');
    }

    public function switchLangAle(Request $request)
    {
        $locale = $request->input('lang');
        if (array_key_exists($locale, config('app.languages'))) {
            Session::put('locale', $locale);
        }
        return redirect()->route('clients.profile')->with('success', 'Language changed successfully.');
    }
}
