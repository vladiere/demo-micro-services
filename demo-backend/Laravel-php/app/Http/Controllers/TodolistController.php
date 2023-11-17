<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ServiceController\Service;

class TodolistController extends Controller
{
    public static function getTask(Request $request){
        return Service::getTask($request);
    }
    public static function addTask(Request $request){
        return Service::addTask($request);
    }
    public static function updateTask(Request $request){
        return Service::updateTask($request);
    }
    public Static function doneTask(Request $request){
        return Service::doneTask($request);
    }
    public static function deleteTask(Request $request){
        return Service::deleteTask($request);
    }
}
