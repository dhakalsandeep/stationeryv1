<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseReturnMaster extends Model
{
    protected $guarded = [];
    protected $table = 'purchase_return_masters';

    public function purchase_master()
    {
        return $this->belongsTo(PurchaseMaster::class);
    }

}
