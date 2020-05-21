<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = [];



    public function publisher()
    {
        return $this->belongsTo(Publisher::class,'publishers_id','id');
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function itemType()
    {
        return $this->belongsTo(ItemsType::class, 'items_types_id', 'id');
    }

    public function items_management()
    {
        return $this->hasMany(ItemsManagement::class);
    }

    public function purchase_details()
    {
        return $this->hasMany(PurchaseDetail::class);
    }

    public function issue_details()
    {
        return $this->hasMany(IssueDetail::class);
    }
}
