<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::group([
//     'prefix' => 'auth'
// ], function () {

//   Route::post('/login', 'UserController@signin');
//   Route::post('/logout', 'AuthController@logout');
//   Route::post('/refresh', 'AuthController@refresh');
//   Route::post('/me', 'AuthController@me');

// });


Route::get('/meetups',
[
'uses'=>'MeetupController@index',
]);
Route::get('/meetup/{id}',
[
'uses'=>'MeetupController@show'
]);
Route::post('/meetup',
  array(
'uses'=>'MeetupController@store'
));
Route::put('/meetup/{id}',[
'uses' =>'MeetupController@update'
]);
Route::delete('/meetup/{id}',[
  'uses' =>'MeetupController@destroy'
]);
Route::post('/signup',
array('uses' => 'UserController@signup')
);

Route::post('/signin',
array('uses' => 'UserController@signin')
);


