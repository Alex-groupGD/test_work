<?php



use App\Http\Controllers\dynamicdependetController;

use App\Http\Controllers\DropdownController;

use App\Http\Controllers\MainController;

use Illuminate\Support\Facades\Route;

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
    return view('main');
})->name('main' );







Route::resource('users',UserController::class);
Route::put('/update/user/', 'UserController@update')->name('up');


Route::get('/crete/{user}', 'AvtoController@create')->name('avtos.create');
Route::post('/store/{user}', 'AvtoController@store')->name('avtos.store');
Route::delete('/avtos/delete/{user_id}', 'AvtoController@destroy')->name('avtos.destroy');
Route::get('/edit/{avto}', 'AvtoController@edit')->name('ss');
Route::put('/update/update/{avto}', 'AvtoController@update')->name('avtos.update');


Route::get('/home', [ DropdownController::class, 'index' ])->name('park');
Route::get('/dropdown-data',[DropdownController::class, 'data']);
Route::post('/dropdown',[DropdownController::class, 'avto'])->name('avto');
Route::get('/dropdown-out/{avt}',[DropdownController::class, 'avto_out'])->name('avto_out');
