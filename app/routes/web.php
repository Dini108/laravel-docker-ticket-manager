<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');
Auth::routes(['register' => true]);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'SystemCalendarController@index')->name('systemCalendar');
    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Performers
    Route::delete('performers/destroy', 'PerformersController@massDestroy')->name('performers.massDestroy');
    Route::resource('performers', 'PerformersController');

    // Places
    Route::delete('places/destroy', 'PlacesController@massDestroy')->name('places.massDestroy');
    Route::resource('places', 'PlacesController');

    // Events
    Route::delete('events/destroy', 'EventsController@massDestroy')->name('events.massDestroy');
    Route::resource('events', 'EventsController');

    //Tickets
    Route::delete('tickets/destroy', 'TicketsController@massDestroy')->name('tickets.massDestroy');
    Route::resource('tickets', 'TicketsController');
    Route::post('ticket/create', 'TicketsController@create')->name('tickets.create');
    Route::get('my_tickets', 'TicketsController@my_tickets')->name('tickets.my_tickets');
    Route::post('tickets/create', 'TicketsController@massBuy')->name('tickets.massBuy');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
});
