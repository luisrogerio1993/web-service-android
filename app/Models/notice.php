<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class notice extends Model
{
    protected $table = "notices";
    
    protected $fillable = [
        'image',
        'title',
        'notice',
        ];
}
