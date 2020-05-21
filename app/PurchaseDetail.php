<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    protected $guarded = [];

    public function items_management()
    {
        return $this->hasOne(ItemsManagement::class);
    }

    public function items()
    {
        return $this->belongsTo(Item::class,'items_id','id');
    }

    public function purchase_master()
    {
        return $this->belongsTo(PurchaseMaster::class,'purchase_masters_id','id');
    }
}
