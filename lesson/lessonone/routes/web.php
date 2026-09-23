<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudentsController;

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

// -------- 
// Route::get('/about/company/{staff}',function($staff){
//     return "Hello {$staff}";
// });


Route::get('/about/company/{staff}',function($staff){
    return view("aboutcompanystaff",["person"=>$staff]);
});

Route::get('/about/company/{staff}/{city}',function($staff,$city){
    return view("aboutcompanystaffbycity",["person"=>$staff,"location"=>$city]);
});

Route::get('/profile',function(){
    return view("myprofile");
})->name("prof");


// ----------------------------------- 

// Route::get('/students',[\App\Http\Controllers\StudentsController::class,'index'])->name('students.index');
// Route::get('/students/show',[\App\Http\Controllers\StudentsController::class,'show'])->name('students.show');
// Route::get('/students/edit',[\App\Http\Controllers\StudentsController::class,'edit'])->name('students.edit');

// Route::group(['prefix'=>'students'],function(){
//     Route::get('/',[\App\Http\Controllers\StudentsController::class,'index'])->name('students.index');
//     Route::get('/show',[\App\Http\Controllers\StudentsController::class,'show'])->name('students.show');
//     Route::get('/edit',[\App\Http\Controllers\StudentsController::class,'edit'])->name('students.edit');
// });

// Route::get('/students',[StudentsController::class,'index'])->name('students.index');
// Route::get('/students/show',[StudentsController::class,'show'])->name('students.show');
// Route::get('/students/edit',[StudentsController::class,'edit'])->name('students.edit');

// Route::group(['prefix'=>'students'],function(){
//     Route::get('/',[StudentsController::class,'index'])->name('students.index');
//     Route::get('/show',[StudentsController::class,'show'])->name('students.show');
//     Route::get('/edit',[StudentsController::class,'edit'])->name('students.edit');
// });


Route::name('students.')->group(function(){
    Route::get('/students',[StudentsController::class,'index'])->name('index');
    Route::get('/students/show',[StudentsController::class,'show'])->name('show');
    Route::get('/students/edit',[StudentsController::class,'edit'])->name('edit');
});




