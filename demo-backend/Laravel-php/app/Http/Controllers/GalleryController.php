<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ServiceController\Service;

class GalleryController extends Controller
{
    public static function getUserGallery(Request $request){
        return Service::getUserGallery($request);
    }
    public static function getImage($filename){
        return Service::getImage($filename);
    }
    public static function addImage(Request $request){
        return Service::addImage($request);
    }
    public static function deleteImage(Request $request){
        return Service::deleteImage($request);
    }
}
