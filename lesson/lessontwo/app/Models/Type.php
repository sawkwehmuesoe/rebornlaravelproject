<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'types';
    protected $pirmaryKey = 'id';
    protected $fillable = [
        'name',
        'slug',
        'status_id',
        'user_id'
    ];

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
