<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $guarded = [];

    public function countries()
    {
        return $this->hasOne(Countries::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
