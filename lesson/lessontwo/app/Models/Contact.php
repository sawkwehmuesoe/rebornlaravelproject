<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';
    protected $pirmaryKey = 'id';
    protected $fillable = [
        'firstname',
        'lastname',
        'gender_id',
        'birthday',
        'relative_id',
        'user_id',
    ];

    public function gender(){
        return $this->belongsTo(Gender::class);
    }

    public function relative(){
        return $this->belongsTo(Relative::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    } 
}
