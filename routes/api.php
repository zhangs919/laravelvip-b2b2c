<?php

use Illuminate\Http\Request;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//use Dingo\Api\Routing\Helpers;
//
//$api = app('Dingo\Api\Routing\Router');
//
//$api->version('v1', ['middleware'=>'api.auth'], function ($api) {
//    $api->get('user/{id}', 'App\Http\Controllers\TestController@show')->name('users.show');
//    $api->get('users', 'App\Http\Controllers\TestController@index')->name('users.index');
//    $url = app('Dingo\Api\Routing\UrlGenerator')->version('v1')->route('users.index');
//
//    $api->put('user/{id}', function ($id) {
//        $user = \App\User::findOrFail($id);
//        if ($user->updated_at > app('request')->get('last_updated')) {
//            throw new \Symfony\Component\HttpKernel\Exception\ConflictHttpException('User was updated prior to your request.');
//        }
//
//    });
//
//    $api->post('users', function (){
//        $rules = [
//            'name' => ['required', 'alpha'],
//            'password' => ['required', 'min:7']
//        ];
//        $payload = app('request')->only('name', 'password');
//        $validator = app('validator')->make($payload, $rules);
//        if ($validator->fails()) {
//            throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not create new user.', $validator->errors());
//        }
//    });
//
//
//
//
//});


