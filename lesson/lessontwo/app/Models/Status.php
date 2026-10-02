<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    
    protected $table = 'statuses';
    protected $pirmaryKey = 'id';
    protected $fillable = [
        'name',
        'slug',
        'user_id'
    ];

}


// $ php artisan make:model Status -m