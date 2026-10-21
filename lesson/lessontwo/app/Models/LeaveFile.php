<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveFile extends Model
{
    protected $table = 'leave_files';
    protected $pirmaryKey = 'id';
    protected $fillable = [
        'leave_id',
        'image'
    ];

    public function leave(){
        return $this->belongsTo(Leave::class);
    }

    
}
