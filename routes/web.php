<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('home/');
});

// Route::get('/chatRoom', function () {
//     return view('chat_home');
// });

//Add new Employee
Route::get('/employees', 'EmployeesController@index')->name('employees.index');
Route::post('/employees/search', 'EmployeesController@search')->name('employees.search');
Route::get('/employees/{id}/edit', 'EmployeesController@edit_employee')->name('employees.edit');
Route::put('/employees/{id}', 'EmployeesController@update_employee')->name('employees.update');
Route::delete('/employees/{id}', 'EmployeesController@destroy_employee')->name('employees.destroy');
Route::get('/profile', 'EmployeesController@showProfile')->name('employees.showProfile');

//---------------------------------------------------------------------------------------------------

//upload employee file
Route::get('/upload', 'EmployeesController@showForm');
Route::post('/upload', 'EmployeesController@storeData');

//---------------------------------------------------------------------------------------------------
//Add new Employee Balance


Route::get('/employees_balance/search_balance', 'BalanceController@user_index')->name('employee_balance.index_users');
Route::get('/employees_balance/{id}', 'BalanceController@show_employee_balance')->name('employee_balance.show');
Route::post('/employees_balance/search', 'BalanceController@search')->name('employee_balance.search');
Route::get('/employees_balance/{id}/{emp_code}/create', 'BalanceController@create_balance')->name('employee_balance.create');
Route::post('/employees_balance/{id}/{emp_code}', 'BalanceController@store_balance')->name('employee_balance.store');
Route::get('/employees_balance/{id}/edit', 'BalanceController@edit_employee_balance')->name('employee_balance.edit');
Route::put('/employees_balance/{id}', 'BalanceController@update_employee_balance')->name('employee_balance.update');
Route::delete('/employees_balance/{user_id}/{id}', 'BalanceController@destroy_employee_balance')->name('employee_balance.destroy');
//---------------------------------------------------------------------------------------------------


//upload employee balance file
Route::get('/upload_balance', 'BalanceController@showForm');
Route::post('/upload_balance', 'BalanceController@storeData');

//---------------------------------------------------------------------------------------------------


//---------------------------------------------------------------------------------------------------
//Add new Employee Salary


Route::get('/employees_salary/search_salary', 'EmployeeSalaryController@user_index')->name('employee_salary.index_users');
Route::get('/employees_salary/{id}', 'EmployeeSalaryController@show_employee_salary')->name('employee_salary.show');
Route::post('/employees_salary/search', 'EmployeeSalaryController@search')->name('employee_salary.search');
Route::get('/employees_salary/{id}/{emp_code}/create', 'EmployeeSalaryController@create_salary')->name('employee_salary.create');
Route::post('/employees_salary/{id}/{emp_code}', 'EmployeeSalaryController@store_salary')->name('employee_salary.store');
Route::get('/employees_salary/{id}/edit', 'EmployeeSalaryController@edit_employee_salary')->name('employee_salary.edit');
Route::put('/employees_salary/{id}', 'EmployeeSalaryController@update_employee_salary')->name('employee_salary.update');
Route::delete('/employees_salary/{user_id}/{id}', 'EmployeeSalaryController@destroy_employee_salary')->name('employee_salary.destroy');
//---------------------------------------------------------------------------------------------------


//upload employee balance file
Route::get('/upload_salary', 'EmployeeSalaryController@showForm');
Route::post('/upload_salary', 'EmployeeSalaryController@storeData');

//---------------------------------------------------------------------------------------------------


//---------------------------------------------------------------------------------------------------
//Add new Employee notification

Route::get('/employees_notify/group_notification', 'NotificationController@group_notification_show')->name('employee_note.group_show');
Route::post('/employees_notify/group_notification', 'NotificationController@group_notification_add')->name('employee_note.group_add');

Route::get('/employees_notify/search_notification', 'NotificationController@user_index')->name('employee_note.index_users');
Route::get('/employees_notify/{id}', 'NotificationController@show_employee_notes')->name('employee_note.edit');
Route::post('/employees_notify/search', 'NotificationController@search')->name('employee_note.search');
Route::get('/employees_notify/{id}/{emp_code}/create', 'NotificationController@create_note')->name('employee_note.create');
Route::post('/employees_notify/{id}/{emp_code}', 'NotificationController@store_note')->name('employee_note.store');
Route::get('/employees_notify/{id}/edit', 'NotificationController@edit_employee_note')->name('employee_note.edit');
Route::put('/employees_notify/{id}', 'NotificationController@update_employee_note')->name('employee_note.update');
Route::delete('/employees_notify/{user_id}/{id}', 'NotificationController@destroy_employee_note')->name('employee_note.destroy');
//---------------------------------------------------------------------------------------------------


//upload employee notification file
Route::get('/upload_note', 'NotificationController@showForm');
Route::post('/upload_note', 'NotificationController@storeData');

//---------------------------------------------------------------------------------------------------


//---------------------------------------------------------------------------------------------------
//Add new General notification


Route::get('/generaklNotifications', 'GeneralNotificationController@index')->name('general_note.index');
Route::get('/generaklNotifications/createNote', 'GeneralNotificationController@create_note')->name('general_note.create');
Route::post('/generaklNotifications', 'GeneralNotificationController@store_note')->name('general_note.store');
Route::delete('/generaklNotifications/{id}', 'GeneralNotificationController@destroy_note')->name('general_note.destroy');
Route::get('/generaklNotifications/{id}/edit', 'GeneralNotificationController@edit_note')->name('general_note.edit');
Route::put('/generaklNotifications/{id}', 'GeneralNotificationController@update_note')->name('general_note.update');
//---------------------------------------------------------------------------------------------------


//---------------------------------------------------------------------------------------------------
//Add Slider Tips


Route::get('/HrTipsSlider', 'HrTipsSliderController@index')->name('hr_tip.index');
Route::get('/HrTipsSlider/createTip', 'HrTipsSliderController@create_tip')->name('hr_tip.create');
Route::post('/HrTipsSlider', 'HrTipsSliderController@store_tip')->name('hr_tip.store');
Route::delete('/HrTipsSlider/{id}', 'HrTipsSliderController@destroy_tip')->name('hr_tip.destroy');
Route::get('/HrTipsSlider/{id}/edit', 'HrTipsSliderController@edit_tip')->name('hr_tip.edit');
Route::put('/HrTipsSlider/{id}', 'HrTipsSliderController@update_tip')->name('hr_tip.update');
//---------------------------------------------------------------------------------------------------

//upload general notification file
// Route::get('/upload_note', 'NotificationController@showForm');
// Route::post('/upload_note', 'NotificationController@storeData');

//---------------------------------------------------------------------------------------------------
//tickets-----
Route::resource('tickets' ,'TicketsController');

//complain-----
Route::resource('complains' ,'ComplainController');
Route::post('/complains/reply', 'ComplainController@storeReply')->name('complain_replay.store');
//-------------

//chat routes
Route::get('Chat','ChatController@chat');
Route::get('chatSession',function()
{
    return session('chatSession');
});

Route::post('send','ChatController@send');
Route::post('getOldMessages','ChatController@getOldMessages');
Route::post('deleteSession','ChatController@deleteSession');
Route::post('saveToSession','ChatController@saveToSession');
//-----------

Route::get('chatRoom','MessageController@chat');
Route::get('allUsres', 'MessageController@all_users_list')->name('allUsres');
Route::get('userList', 'MessageController@user_list')->name('users');
Route::post('userListSearch', 'MessageController@search_users')->name('userListSearch');
Route::get('userMessages/{id}', 'MessageController@user_messages')->name('userMessages');
Route::post('sendMessage', 'MessageController@send_message')->name('sendMessage');
Route::get('deleteSingleMessage/{id}', 'MessageController@delete_single_message')->name('deleteSingleMessage');
Route::get('deleteAllMessages/{id}', 'MessageController@delete_all_message')->name('deleteAllMessages');
Route::get('allGroups', 'MessageController@all_users_groups')->name('allGroups');
Route::post('groupUsers', 'MessageController@all_group_users')->name('groupUsers');


//--------------------------------------WhatsApp Messages-------------------------------------------------------------


//upload employee notification file
Route::get('/wMessages', 'WhatsMessage@index')->name('wMessages');
Route::post('/sendWMessages', 'WhatsMessage@sendWMessages')->name('sendWMessages');

//---------------------------------------------------------------------------------------------------

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => 'web'], function () {
    Route::resource('Api/login/getAllData', 'ApiLoginController');
});

Route::group(['middleware' => 'web'], function () {
    Route::resource('Api/getAllData', 'ApiController');
});


