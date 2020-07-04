<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemsManagement extends Model
{
    protected $guarded = [];
    protected $table = 'items_managements';



    public function item()
    {
        return $this->belongsTo(Item::class,'items_id','id');
    }

    public function issue_details()
    {
        return $this->hasMany(IssueDetail::class,'items_managements_id','id');
    }


}
