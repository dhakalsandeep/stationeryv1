<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function purchase_master()
    {
        return $this->hasMany(PurchaseMaster::class);
    }
}
