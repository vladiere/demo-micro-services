<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodolistController;
use App\Http\Controllers\GalleryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/getUserTask/{user_id}',[TodolistController::class,'getTask']);
Route::get('/getUserGallery/{user_id}',[GalleryController::class,'getUserGallery']);
Route::get('/getImage/{filename}',[GalleryController::class,'getImage']);
Route::post('/addTask',[TodolistController::class,'addTask']);
Route::post('/updateTask',[TodolistController::class,'updateTask']);
Route::post('/deleteTask',[TodolistController::class,'deleteTask']);
Route::post('/addImage',[GalleryController::class,'addimage']);
Route::post('/deleteImage',[GalleryController::class,'deleteimage']);

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
