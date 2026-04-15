<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    protected $fillable = [
        'title',
        'description',
        'phone',
        'user_id',
        'category_id',
    ];

    public function category(){

        return $this->belongsTo(Category::class);
    }
    
}
