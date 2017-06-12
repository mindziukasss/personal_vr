<?php


use App\Models\VrLanguageCodes;

function getActiveLanguages()
{
    $languages = VrLanguageCodes::where('is_active', 1)->get()->pluck('name', 'id');

    return $languages;
}