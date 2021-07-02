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

Route::get('logout', 'App\Http\Controllers\Auth\LoginController@logout');

// Booking Email Robot route-k
Route::get('/admin/booking/emails/emailmorning', 'App\Http\Controllers\Robot\SendEmailsController@send_email_booking_morning')->name('admin/booking/emails/emailmorning');
Route::get('/admin/booking/emails/emailconfirm', 'App\Http\Controllers\Robot\SendEmailsController@send_email_booking_confirm')->name('admin/booking/emails/emailconfirm');
Route::get('/emails/confirm/{hash}', 'App\Http\Controllers\Robot\SendEmailsController@send_email_booking_confirm_after')->name('/emails/confirm/{hash}');
Route::get('/emails/delete/{hash}', 'App\Http\Controllers\Robot\SendEmailsController@send_email_booking_delete_after_pre')->name('/emails/delete/{hash}');
Route::get('/emails/delete_confirmed/{hash}', 'App\Http\Controllers\Robot\SendEmailsController@send_email_booking_delete_after')->name('/emails/delete_confirmed/{hash}');

// CRON route-k
Route::get('/admin/booking/emails/checkemailbeforebooking', 'App\Http\Controllers\Robot\CheckToSendController@check_email_before_booking')->name('admin/booking/emails/checkemailbeforebooking');
Route::get('/admin/booking/emails/checkemailconfirmed', 'App\Http\Controllers\Robot\CheckToSendController@check_email_confirmed')->name('admin/booking/emails/checkemailconfirmed');

// Booking Email Robot route-k

// alap visitors route-k
Route::get('/', 'App\Http\Controllers\VisitorsController@index')->name('index');
Route::get('/index', 'App\Http\Controllers\VisitorsController@index')->name('index');
Route::get('/rolunk', 'App\Http\Controllers\VisitorsController@about')->name('rolunk');
Route::get('/allasok', 'App\Http\Controllers\VisitorsController@jobs')->name('allasok');
Route::get('/autoszerviz/szolgaltatasok', 'App\Http\Controllers\VisitorsController@CarServices')->name('autoszerviz/szolgaltatasok');
Route::get('/autoszerviz/arlista', 'App\Http\Controllers\VisitorsController@CarPriceList')->name('autoszerviz/arlista');
Route::get('/gumiszerviz/szolgaltatasok', 'App\Http\Controllers\VisitorsController@TireServices')->name('gumiszerviz/szolgaltatasok');
Route::get('/gumiszerviz/arlista', 'App\Http\Controllers\VisitorsController@TirePriceList')->name('gumis/arlista');
Route::get('/kapcsolat', 'App\Http\Controllers\VisitorsController@contact')->name('kapcsolat');
Route::post('/kapcsolat', 'App\Http\Controllers\VisitorsController@contact_post')->name('kapcsolat_post');

Route::get('/idopontfoglalo', 'App\Http\Controllers\VisitorsCalendarController@freedates')->name('idopontfoglalo');
Route::get('/hirek', 'App\Http\Controllers\VisitorsController@hirek')->name('hirek');

Auth::routes();

// admin route-k
Route::get('/admin', 'App\Http\Controllers\Admin\PagesController@index')->name('admin');
Route::get('/admin/home', 'App\Http\Controllers\Admin\AdminController@index')->name('admin/home');
Route::get('/admin/users', 'App\Http\Controllers\Admin\UsersAdminController@index')->name('admin/users');
Route::get('/admin/permissions', 'App\Http\Controllers\Admin\PermissionsAdminController@index')->name('admin/permissions');
Route::get('/admin/settings', 'App\Http\Controllers\Admin\SettingsAdminController@index')->name('admin/settings');
Route::get('/admin/analytics', 'App\Http\Controllers\Admin\SettingsAdminController@analytics')->name('admin/analytics');
Route::get('/admin/social', 'App\Http\Controllers\Admin\SettingsAdminController@social')->name('admin/social');
Route::post('/admin/users/create', 'App\Http\Controllers\Auth\RegisterController@create')->name('admin/users/create');
Route::post('/admin/users/update', 'App\Http\Controllers\Admin\UsersAdminController@update')->name('admin/users/update');
Route::put('/admin/users/remove/{id}', 'App\Http\Controllers\Admin\UsersAdminController@remove')->name('admin/users/remove/{id}');
Route::get('/admin/user/{id}', 'App\Http\Controllers\Admin\UsersAdminController@geUsertDetails')->name('admin/user/{id}');
Route::get('/admin/pages', 'App\Http\Controllers\Admin\PagesController@index')->name('admin/pages');
Route::get('/admin/pages/{id}', 'App\Http\Controllers\Admin\BlocksController@GetPage')->name('admin/pages/{id}');
Route::get('/admin/menu', 'App\Http\Controllers\Admin\PagesController@menu')->name('admin/menu');
Route::get('/admin/gallery', 'App\Http\Controllers\Admin\GalleryController@index')->name('admin/gallery');

// booking route-k
Route::get('/admin/booking', 'App\Http\Controllers\Admin\BookingController@index')->name('admin/booking');
Route::get('/admin/bookingtoday', 'App\Http\Controllers\Admin\BookingController@bookingtoday')->name('admin/bookingtoday');
Route::get('/admin/booking/services', 'App\Http\Controllers\Admin\ServicesController@index')->name( 'admin/booking/services');
Route::get('/admin/booking/settings', 'App\Http\Controllers\Admin\BookingsSettingsController@index')->name( 'admin/booking/settings');

Route::post('/admin/booking/settings/extradates_is_exists', 'App\Http\Controllers\Admin\BookingsSettingsController@extradates_is_exists')->name( '/admin/booking/settings/extradates_is_exists');
Route::post('/admin/booking/settings/extradates_upload', 'App\Http\Controllers\Admin\BookingsSettingsController@extradates_upload')->name( '/admin/booking/settings/extradates_upload');
Route::post('/admin/booking/settings/extradates_list', 'App\Http\Controllers\Admin\BookingsSettingsController@extradates_list')->name( '/admin/booking/settings/extradates_list');
Route::post('/admin/booking/settings/extradates_update_open', 'App\Http\Controllers\Admin\BookingsSettingsController@extradates_update_open')->name( '/admin/booking/settings/extradates_update_open');
Route::post('/admin/booking/settings/extradates_update_close', 'App\Http\Controllers\Admin\BookingsSettingsController@extradates_update_close')->name( '/admin/booking/settings/extradates_update_close');
Route::post('/admin/booking/settings/extradates_delete_open', 'App\Http\Controllers\Admin\BookingsSettingsController@extradates_delete_open')->name( '/admin/booking/settings/extradates_delete_open');
Route::post('/admin/booking/settings/extradates_delete_close', 'App\Http\Controllers\Admin\BookingsSettingsController@extradates_delete_close')->name( '/admin/booking/settings/extradates_delete_close');

Route::post('/admin/booking/settings/update', 'App\Http\Controllers\Admin\BookingsSettingsController@update_bookings_settings')->name( '/admin/booking/settings/update');
Route::post('/admin/booking/insert', 'App\Http\Controllers\Admin\BookingController@insert')->name( '/admin/booking/insert');
Route::post('/admin/booking/insert_admin', 'App\Http\Controllers\Admin\BookingController@insert_admin')->name( '/admin/booking/insert_admin');

// Booking edit
Route::post('/admin/booking/car/edit_get_datas', 'App\Http\Controllers\BookingsCarsController@edit_get_datas')->name( '/admin/booking/car/edit_get_datas');
Route::post('/admin/booking/car/edit_update', 'App\Http\Controllers\BookingsCarsController@edit_update')->name( '/admin/booking/car/edit_update');
Route::post('/admin/booking/car/edit_delete', 'App\Http\Controllers\BookingsCarsController@edit_delete')->name( '/admin/booking/car/edit_delete');
Route::post('/admin/booking/tire/edit_get_datas', 'App\Http\Controllers\BookingsTiresController@edit_get_datas')->name( '/admin/booking/tire/edit_get_datas');
Route::post('/admin/booking/tire/edit_update', 'App\Http\Controllers\BookingsTiresController@edit_update')->name( '/admin/booking/tire/edit_update');
Route::post('/admin/booking/tire/edit_delete', 'App\Http\Controllers\BookingsTiresController@edit_delete')->name( '/admin/booking/tire/edit_delete');

// BOOKING SESSION KEZELÉS
Route::post('/admin/booking/carservices/get_session', 'App\Http\Controllers\BookingsCarsController@get_session')->name( '/admin/booking/carservices/get_session');
Route::post('/admin/booking/carservices/insert_update_session', 'App\Http\Controllers\BookingsCarsController@insert_update_session')->name( '/admin/booking/carservices/insert_update_session');
Route::post('/admin/booking/tireservices/get_session', 'App\Http\Controllers\BookingsTiresController@get_session')->name( '/admin/booking/tireservices/get_session');
Route::post('/admin/booking/tireservices/insert_update_session', 'App\Http\Controllers\BookingsTiresController@insert_update_session')->name( '/admin/booking/tireservices/insert_update_session');

// BOOKING SESSION KEZELÉS - VISITORS
Route::post('/visitors/booking/carservices/get_session', 'App\Http\Controllers\BookingsCarsVisitorsController@get_session')->name( '/visitors/booking/carservices/get_session');
Route::post('/visitors/booking/carservices/insert_update_session', 'App\Http\Controllers\BookingsCarsVisitorsController@insert_update_session')->name( '/visitors/booking/carservices/insert_update_session');
Route::post('/visitors/booking/tireservices/get_session', 'App\Http\Controllers\BookingsTiresVisitorsController@get_session')->name( '/visitors/booking/tireservices/get_session');
Route::post('/visitors/booking/tireservices/insert_update_session', 'App\Http\Controllers\BookingsTiresVisitorsController@insert_update_session')->name( '/visitors/booking/tireservices/insert_update_session');

//auto szolgáltatások
Route::post('/admin/booking/carservices/update', 'App\Http\Controllers\ServicesCarsController@update')->name( '/admin/booking/carservices/update');
Route::delete('/admin/booking/carservices/remove/{id}', 'App\Http\Controllers\ServicesCarsController@remove')->name( '/admin/booking/carservices/remove/{id}');
Route::post('/admin/booking/carservices/insert', 'App\Http\Controllers\ServicesCarsController@insert')->name( '/admin/booking/carservices/insert');

//gumiszerviz szolgáltatások
Route::post( '/admin/booking/tireservices/update', 'App\Http\Controllers\ServicesTiresController@update')->name( '/admin/booking/tireservices/update');
Route::delete( '/admin/booking/tireservices/remove/{id}', 'App\Http\Controllers\ServicesTiresController@remove')->name( '/admin/booking/tireservices/remove/{id}');
Route::post( '/admin/booking/tireservices/insert', 'App\Http\Controllers\ServicesTiresController@insert')->name( '/admin/booking/tireservices/insert');

// calendar route-k
Route::get('/admin/booking/calendar', 'App\Http\Controllers\Admin\CalendarController@index')->name('admin/booking/calendar');
Route::post('/ajax/update_payment/tire', 'App\Http\Controllers\BookingsTiresController@update_payment')->name('/ajax/update_payment/tire');
Route::post('/ajax/update_payment/car', 'App\Http\Controllers\BookingsCarsController@update_payment')->name('/ajax/update_payment/car');
Route::post('/ajax/delete_payment/tire', 'App\Http\Controllers\BookingsTiresController@delete_payment')->name('/ajax/delete_payment/tire');
Route::post('/ajax/delete_payment/car', 'App\Http\Controllers\BookingsCarsController@delete_payment')->name('/ajax/delete_payment/car');
Route::post('/ajax/update_calendar/tire', 'App\Http\Controllers\BookingsTiresController@update_calendar')->name('/ajax/update_calendar/tire');
Route::post('/ajax/update_calendar/car', 'App\Http\Controllers\BookingsCarsController@update_calendar')->name('/ajax/update_calendar/car');
Route::post('/ajax/visitors/update_calendar/tire', 'App\Http\Controllers\BookingsTiresVisitorsController@update_calendar')->name('/ajax/visitors/update_calendar/tire');
Route::post('/ajax/visitors/update_calendar/car', 'App\Http\Controllers\BookingsCarsVisitorsController@update_calendar')->name('/ajax/visitors/update_calendar/car');
Route::get( '/admin/booking/services/{type}/list', 'App\Http\Controllers\Admin\ServicesController@getListByType')->name( '/admin/booking/services/{type}/list');


//Car Type
Route::get('/carType/{id}', 'App\Http\Controllers\CarTypesController@getAllCarBrands')->name( '/carType/{id}');

// ajax postok
Route::post('/admin/ajax/pages', 'App\Http\Controllers\Admin\AjaxController@pages')->name('admin/ajax/pages');
Route::post('/admin/ajax/blocks', 'App\Http\Controllers\Admin\AjaxController@blocks')->name('admin/ajax/blocks');
Route::post('/admin/ajax/blocks/append', 'App\Http\Controllers\Admin\AjaxController@blocks_append')->name('admin/ajax/blocks/append');
Route::post('/admin/ajax/menus/menus_order', 'App\Http\Controllers\Admin\AjaxController@menus_order')->name('admin/ajax/menus/menus_order');
Route::post('/admin/ajax/menus/menu_settings', 'App\Http\Controllers\Admin\AjaxController@menu_settings')->name('admin/ajax/menus/menu_settings');
Route::post('/admin/ajax/menus/menu_save', 'App\Http\Controllers\Admin\AjaxController@menu_save')->name('admin/ajax/menus/menu_save');
Route::post('/admin/ajax/settings/analytics', 'App\Http\Controllers\Admin\AjaxController@settings_analytics')->name('admin/ajax/settings/analytics');
Route::post('/admin/ajax/settings/settings_social', 'App\Http\Controllers\Admin\AjaxController@settings_social')->name('admin/ajax/settings/settings_social');
Route::post('/admin/ajax/dark_mode', 'App\Http\Controllers\Admin\AjaxController@dark_mode')->name('admin/ajax/dark_mode');
Route::post('/admin/permissions/update', 'App\Http\Controllers\Admin\PermissionsAdminController@update')->name('admin/permissions/update');
// Route::post('/admin/ajax/update_calendar', 'App\Http\Controllers\Admin\AjaxController@update_calendar')->name('/admin/ajax/update_calendar');

// ajax FILTER postok
Route::post('/admin/ajax/filters/tires', 'App\Http\Controllers\Admin\BookingController@filter_tires')->name('admin/ajax/filters/tires');
Route::post('/admin/ajax/filters/cars', 'App\Http\Controllers\Admin\BookingController@filter_cars')->name('admin/ajax/filters/cars');
