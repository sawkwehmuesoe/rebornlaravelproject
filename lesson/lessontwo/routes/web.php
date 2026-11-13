<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AnnouncementsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\DaysController;
use App\Http\Controllers\GendersController;
use App\Http\Controllers\LeavesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\PaymentTypesController;
use App\Http\Controllers\RelativesController;
use App\Http\Controllers\ReligionsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\StagesController;
use App\Http\Controllers\StatusesController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\TypesController;
use App\Http\Controllers\WarehousesController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/register/step1',[RegisteredUserController::class,'createstep1'])->name('register.step1');
// Route::post('/register/step1',[RegisteredUserController::class,'storestep1'])->name('register.stirestep1');

// Route::get('/register/step2',[RegisteredUserController::class,'createstep2'])->name('register.step2');
// Route::post('/register/step2',[RegisteredUserController::class,'storestep2'])->name('register.stirestep2');

// Route::get('/register/step3',[RegisteredUserController::class,'createstep3'])->name('register.step3');
// Route::post('/register/step3',[RegisteredUserController::class,'storestep3'])->name('register.stirestep3');

Route::middleware('auth')->group(function () {

    Route::resource('/announcements',AnnouncementsController::class);
    Route::delete('announcementsbulkdeletes',[AnnouncementsController::class,'bulkdeletes'])->name('announcements.bulkdeletes');

    Route::resource('contacts',ContactsController::class);
    Route::delete('contactsbulkdeletes',[ContactsController::class,'bulkdeletes'])->name("contacts.bulkdeletes");

    Route::resource('leaves',LeavesController::class);
    Route::put('/leaves/{id}/updatestage',[LeavesController::class, 'updatestage'])->name('leaves.updatestage');
    Route::delete('leavesbulkdeletes',[LeavesController::class,'bulkdeletes'])->name('leaves.bulkdeletes');

    Route::resource('posts',PostsController::class);
    Route::delete('postsbulkdeletes',[PostsController::class,'bulkdeletes'])->name('posts.bulkdeletes');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('roles',RolesController::class);
    Route::delete('rolesbulkdeletes',[RolesController::class,'bulkdeletes'])->name('roles.bulkdeletes');

    Route::resource('statuses',StatusesController::class);
    Route::delete('statusesbulkdeletes',[StatusesController::class,'bulkdeletes'])->name('statuses.bulkdeletes');

    Route::resource('types',TypesController::class);
    Route::delete('typesbulkdeletes',[TypesController::class,'bulkdeletes'])->name('types.bulkdeletes');

    Route::resource('categories',CategoriesController::class);
    Route::delete('categoriesbulkdeletes',[CategoriesController::class,'bulkdeletes'])->name('categories.bulkdeletes');
    
    Route::resource('days',DaysController::class);
    Route::delete('daysbulkdeletes',[DaysController::class,'bulkdeletes'])->name('days.bulkdeletes');

    Route::resource('genders',GendersController::class);
    Route::delete('gendersbulkdeletes',[GendersController::class,'bulkdeletes'])->name('genders.bulkdeletes');

    Route::resource('paymenttypes',PaymentTypesController::class);
    Route::delete('paymenttypesbulkdeletes',[PaymentTypesController::class,'bulkdeletes'])->name('paymenttypes.bulkdeletes');

    Route::resource('relatives',RelativesController::class);
    Route::delete('relativesbulkdeletes',[RelativesController::class,'bulkdeletes'])->name('relatives.bulkdeletes');

    Route::resource('religions',ReligionsController::class);
    Route::delete('religionsbulkdeletes',[ReligionsController::class,'bulkdeletes'])->name('religions.bulkdeletes');

    Route::resource('stages',StagesController::class);
    Route::delete('stages',[StagesController::class,'bulkdeletes'])->name('stages.bulkdeletes');

    Route::resource('tags',TagsController::class);
    Route::delete('tagsbulkdeltes',[TagsController::class,'bulkdeletes'])->name('tags.bulkdeletes');

    Route::resource('warehouses',WarehousesController::class);
    Route::delete('warehousesbulkeletes',[WarehousesController::class,'bulkdeletes'])->name('warehouses.bulkdeletes');
});

require __DIR__.'/auth.php';
