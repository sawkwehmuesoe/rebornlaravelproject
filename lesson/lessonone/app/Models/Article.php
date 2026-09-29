<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = "articles";
    protected $primaryKey = "id";

    // Mass Assignment 
    // method 1 

    // protected $fillable = [
    //     'title',
    //     'description',
    //     'user_id',
    //     'rating'
    // ]


    // method 2 
    protected $guarded = [];
}
