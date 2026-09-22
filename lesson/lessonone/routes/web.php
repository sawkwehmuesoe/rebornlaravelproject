<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', function () {
    return "Save Myanmar";
});

Route::get('/sayar',function(){
    return "Hay, Sayar Nay Kaung Lar";
});

Route::get('/sayhi',function(){
    return "Hi, Min Gar Lar Par";
});

// Route::get('/about',function(){
//     return view("aboutme");
// });

Route::view('about',"aboutme");

Route::view('/about/company',"aboutcompany");

// => Redirect 

// Route::get('/contact',function(){
//     return redirect("/about");
// });

Route::redirect('/contact','/about/company');



