<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});
    // Don't have any authentication can be accessed by anyone
Route::get('/',[BaseController::class,'home'])->name('home');
Route::get('/login',[BaseController::class,'login'])->name('login');
Route::post('/login',[BaseController::class,'loginCheck'])->name('login.check');
Route::get('/register',[BaseController::class,'register'])->name('register');
Route::post('/register',[BaseController::class,'registerStore'])->name('register.store');

    //All the route under middleware will work only after login
Route::group(['middleware' => 'auth'],function(){
    //For Users
Route::get('/user/dashboard',[UserController::class,'userDashboard'])->name('user.Dashboard');
Route::post('/user/dashboard',[UserController::class,'postStore'])->name('post.store');
Route::get('/user/viewPost',[UserController::class,'viewPost'])->name('view.post');
Route::get('/user/editPost/{id}',[UserController::class,'editPost'])->name('edit.post');
Route::post('/user/editPost/{id}',[UserController::class,'updatePost'])->name('update.post');
Route::post('/user/deletePost',[UserController::class,'destroy'])->name('delete.post');
Route::get('/logout',[UserController::class,'logout'])->name('logout');

    //For Admin
Route::get('/admin/dashboard',[AdminController::class,'adminDashboard'])->name('admin.Dashboard');
Route::post('/admin/dashboard',[AdminController::class,'adminPostStore'])->name('adminPost.store');
// Route::get('/admin/view',[AdminController::class,'adminView'])->name('admin.view');
Route::get('/admin/viewAll',[AdminController::class,'viewAll'])->name('admin.viewAll');
Route::get('/admin/editAll/{id}',[AdminController::class,'editAll'])->name('edit.Allpost');
Route::post('/admin/editAll/{id}',[AdminController::class,'updateAll'])->name('update.Allpost');


});