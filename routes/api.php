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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('user_login','ApiController@user_login');
Route::post('user_complain','ApiController@user_complain');
Route::post('user_data','ApiController@get_user_data');
Route::post('user_complain','ApiController@user_complain');
Route::post('all_user_complains','ApiController@all_user_complains');
Route::post('show_all_complains_replies','ApiController@show_all_complains_replies');
Route::post('user_complain_reply','ApiController@user_complain_reply');
Route::post('show_user_notifications','ApiController@show_user_notifications');
Route::post('show_general_notes','ApiController@show_general_notes');
Route::post('show_user_balance','ApiController@show_user_balance');
Route::post('show_user_salary_details','ApiController@show_user_salary_details');