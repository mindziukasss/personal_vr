<?php

namespace App\Models;



class VrPages extends CoreModel
{
    use UuidTrait;

    /**
     * Database table name
     * @var string
     */
    protected $table = 'vr_pages';
    /**
     * Fillable column names
     * @var array
     */
    protected $fillable = ['id', 'category_id', 'cover_id'];


    protected $with = ['translation', 'cover'];

    public function translation ()
    {

        $lang = request('language_code');
        if($lang == null)
            $lang = app()->getLocale();

        return $this->hasOne(VrPagesTranslations::class, 'record_id' , 'id')
            ->where('language_code', $lang);
    }

    public function cover()
    {
        return $this->hasOne(VrResources::class, 'cover_id', 'id');
    }



}
