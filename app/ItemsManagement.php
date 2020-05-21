<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemsManagement extends Model
{
    protected $guarded = [];
    protected $table = 'items_managements';

    public function purchase_detail()
    {
        return $this->belongsTo(PurchaseDetail::class, 'purchase_details_id', 'id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class,'items_id','id');
    }

    public function items_room_rack()
    {
        return $this->hasMany(ItemsRoomRack::class,'items_managements_id','id');
    }

    public function issue_details()
    {
        return $this->hasMany(IssueDetail::class,'items_managements_id','id');
    }


}
