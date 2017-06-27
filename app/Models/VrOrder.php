<?php

namespace App\Models;



class VrOrder extends CoreModel
{
    use UuidTrait;

    /**
     * Database table name
     * @var string
     */
    protected $table = 'vr_order';
    /**
     * Fillable column names
     * @var array
     */
    protected $fillable = ['id', 'status', 'user_id'];


    public function getUserContact()
    {
        return $this->hasOne(VrUsers::class, 'user_id' , 'id');
    }

}
