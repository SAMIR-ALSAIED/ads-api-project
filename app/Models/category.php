<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $fillable = ['name'];

    public function ads()
    {
        return $this->hasMany(Ads::class);
    }



    
}
