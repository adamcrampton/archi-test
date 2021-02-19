<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'properties', 'as' => 'property.'], function() {
    Route::get('/', 'App\Http\Controllers\Api\Properties\PropertyController@index')->name('index');
    Route::get('/{property}', 'App\Http\Controllers\Api\Properties\PropertyController@show')->name('show');
    Route::post('/', 'App\Http\Controllers\Api\Properties\PropertyController@store')->name('store');
    Route::put('/{property}', 'App\Http\Controllers\Api\Properties\PropertyController@update')->name('update');
    Route::delete('/{property}', 'App\Http\Controllers\Api\Properties\PropertyController@destroy')->name('destroy');
});