<?php

namespace App\Models;


class VRPages extends CoreModel
{
    /**
     * Table name
     * @var string
     */
    protected $table = 'vr_pages';

    /**
     * Fields which will be manipulated
     * @var array
     */
    protected $fillable = ['id', 'category_id', 'resource_id'];


    public function translationsData()
    {
        $languageCode = request()->segment(5);
        return $this->hasOne(VRPagesTranslations::class, 'page_id', 'id')->where('language_id', $languageCode);

    }



}

