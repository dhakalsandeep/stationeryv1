<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemsRoomRack extends Model
{
    protected $guarded = [];

    public function items_managements()
    {
        return $this->hasOne(ItemsManagement::class);
    }
}
