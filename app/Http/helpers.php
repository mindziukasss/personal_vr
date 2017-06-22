<?php


use App\Models\VrLanguageCodes;
use App\Models\VrMenu;
use App\Models\VRPages;

function getActiveLanguages()
{
    $languages = VrLanguageCodes::where('is_active', 1)->get()->pluck('name', 'id')->toArray();
    $locale = app()->getLocale();

    if (!isset($languages[$locale])) {
        $locale = config('app.fallback_locale');

        if (!isset($languages[$locale])) {
            return $languages;
        }

    }

    $languagesLocale = [$locale => $languages[$locale]] + $languages;

    return $languagesLocale;

}


function getFrontendMenu ()
{ 
  $data = VrMenu::where('vr_parent_id', null)->with(['submenu'])
      ->orderBy('sequence', 'desc')->get()->toArray();
    return $data;
}


function getVRrooms ()
{
    $data = VRPages::where('category_id', 'virtual_room')->get()->toArray();

    return $data;
}