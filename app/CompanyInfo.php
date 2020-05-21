<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    protected $guarded = [];
    protected $table = 'company_infos';

    public function user(){
        return $this->hasMany(User::class);
    }
}
