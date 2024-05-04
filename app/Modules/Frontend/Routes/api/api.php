<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/auth/login', '\App\Api\V1\Controllers\AuthController@login'); // 用户登录

Route::post('/auth/logout', '\App\Api\V1\Controllers\AuthController@logout'); // 退出登录


