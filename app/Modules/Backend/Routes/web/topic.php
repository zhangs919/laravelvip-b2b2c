<?php

Route::group(['domain' => env('BACKEND_DOMAIN')], function ($router) {

    // Topic route
    Route::group(['prefix' => 'topic'], function () {
        // Topic route
        Route::group(['prefix' => 'topic'], function () {
            Route::get('bg-setting/{page?}/{topic_id?}', 'Topic\TopicController@bgSetting'); // bgSetting
            Route::post('bg-setting/{page?}/{topic_id?}', 'Topic\TopicController@bgSetting'); // bgSetting
            Route::get('list', 'Topic\TopicController@lists'); // lists
            Route::get('design', 'Topic\TopicController@design'); // design
            Route::get('add', 'Topic\TopicController@add'); // add
            Route::post('add', 'Topic\TopicController@saveData'); // saveData
            Route::get('edit', 'Topic\TopicController@edit'); // edit
            Route::post('edit', 'Topic\TopicController@saveData'); // saveData
            Route::post('delete', 'Topic\TopicController@delete'); // delete
            Route::post('batch-delete', 'Topic\TopicController@batchDelete'); // batchDelete


        });
    });


});