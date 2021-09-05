<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api', 'middleware' => ['auth:api']], function () {

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Performers
    Route::apiResource('performers', 'PerformersApiController');

    // Places
    Route::apiResource('places', 'PlacesApiController');

    // Events
    Route::apiResource('events', 'EventsApiController');

    Route::apiResource('tickets', 'TicketsApiController');
});
