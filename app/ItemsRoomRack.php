<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemsRoomRack extends Model
{
    protected $guarded = [];

    public function issue_details()
    {
        return $this->hasOne(IssueDetail::class);
    }
}
