<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseMaster extends Model
{
    protected $guarded = [];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'suppliers_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }

    public function purchase_details()
    {
        return $this->hasMany(PurchaseDetail::class,'purchase_masters_id','id');
    }
}
