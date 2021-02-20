<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'properties', 'as' => 'property.'], function() {
    // Property CRUD.
    Route::get('/', 'App\Http\Controllers\Api\Properties\PropertyController@index')->name('index');
    Route::get('/{property}', 'App\Http\Controllers\Api\Properties\PropertyController@show')->name('show');
    Route::post('/', 'App\Http\Controllers\Api\Properties\PropertyController@store')->name('store');
    Route::put('/{property}', 'App\Http\Controllers\Api\Properties\PropertyController@update')->name('update');
    Route::delete('/{property}', 'App\Http\Controllers\Api\Properties\PropertyController@destroy')->name('destroy');

    // Property analytics.
    Route::get('/{property}/analytics', 'App\Http\Controllers\Api\Properties\PropertyAnalyticController@show')->name('analytics.show');

    // Analytics.
    Route::post('/analytics', 'App\Http\Controllers\Api\Properties\PropertyAnalyticController@store')->name('analytics.store');
});

Route::group(['prefix' => 'analytics', 'as' => 'analytics.'], function() {
    // Analytics fetch.
    Route::post('/', 'App\Http\Controllers\Api\Analytics\AnalyticController@show')->name('analytics.show');
});