<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IssueDetail extends Model
{
    protected $guarded = [];

    public function items_managements()
    {
        return $this->belongsTo(ItemsManagement::class,'items_managements_id','id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class,'items_id','id');
    }

    public function from_department()
    {
        return $this->belongsTo(Department::class,'from_dep_id','id');
    }

    public function to_department()
    {
        return $this->belongsTo(Department::class,'to_dep_id','id');
    }
}
