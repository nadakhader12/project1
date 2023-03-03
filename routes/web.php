<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\admin\newscontroller;
use App\Http\Controllers\admin\processcontroller;
//use App\Http\Controllers\AdminController;
//use App\Http\Controllers\admin\newscontroller;
//use App\Http\Controllers\admin\processcontroller;
use App\Http\Controllers\admin\Featurescontroller;
use App\Http\Controllers\admin\projectscontroller;
//use App\Http\Controllers\admin\projectscontroller;


Route::prefix('admin')->name('admin.')->middleware('auth','check_user')->group(function() {
    Route::get('/', [AdminController::class, 'index'])->name('index');

// CRUD
// feature
Route::get('features/trash', [Featurescontroller::class, 'trash'])->name('features.trash');
Route::get('features/{id}/restore', [Featurescontroller::class, 'restore'])->name('features.restore');
Route::delete('features/{id}/forcedelete', [Featurescontroller::class, 'forcedelete'])->name('features.forcedelete');
Route::resource('features', Featurescontroller::class);
// process
Route::get('process/trash', [processcontroller::class, 'trash'])->name('process.trash');
Route::get('process/{id}/restore', [processcontroller::class, 'restore'])->name('process.restore');
Route::delete('process/{id}/forcedelete', [processcontroller::class, 'forcedelete'])->name('process.forcedelete');
Route::resource('process', processcontroller::class);

//projects
Route::get('projects/trash', [projectscontroller::class, 'trash'])->name('projects.trash');
Route::get('projects/{id}/restore', [projectscontroller::class, 'restore'])->name('projects.restore');
Route::delete('projects/{id}/forcedelete', [projectscontroller::class, 'forcedelete'])->name('projects.forcedelete');
Route::resource('projects', projectscontroller::class);
//news
Route::get('news/trash', [newscontroller::class, 'trash'])->name('news.trash');
Route::get('news/{id}/restore', [newscontroller::class, 'restore'])->name('news.restore');
Route::delete('news/{id}/forcedelete', [newscontroller::class, 'forcedelete'])->name('news.forcedelete');
Route::resource('news', newscontroller::class);
});






Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::view('not-allowed','not_allowed');
Route::get('/',function(){
return '////';
})->name('site.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
