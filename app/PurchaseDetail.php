<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    protected $guarded = [];

    public function issue_detail()
    {
        return $this->hasOne(IssueDetail::class);
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
