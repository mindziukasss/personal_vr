<?php


use App\Models\VrLanguageCodes;
use App\Models\VrMenu;
use App\Models\VRPages;
use Illuminate\Support\Facades\Schema;

function getActiveLanguages()
{
    if (is_null(Schema::hasTable('vr_language_codes'))) {
        return "DB is empty";
    } else {
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

}


function getFrontendMenu ()
{
    if(is_null(Schema::hasTable('vr_menu'))) {
        return "DB is empty";
    }else {
        $data = VrMenu::where('vr_parent_id', null)->with(['submenu'])
            ->orderBy('sequence', 'desc')->get()->toArray();

        return $data;
    }

}


function getVRrooms ()
{
    if(is_null(Schema::hasTable('vr_categories_translations'))) {
        return "DB is empty";

    }else {
        $data = VRPages::where('category_id', 'virtual_room')->get()->toArray();

        return $data;
    }
}