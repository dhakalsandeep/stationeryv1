<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemsType extends Model
{
    protected $guarded = [];
    protected $table = 'items_types';

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
