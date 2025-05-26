<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\CommandController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModbusController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;

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

Route::middleware(['auth'])->group(function () {

    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard');
        Route::get('/modbus-write', 'indexWrite')->name('dashboard-write');
        Route::get('/modbus-tcpdump', 'indexTcpdump')->name('dashboard-tcpdump');
        Route::get('/ping', 'indexPing')->name('ping.index');
        Route::get('/nmap', 'indexNmap')->name('nmap.index');
        Route::get('/flood', 'indexFlood')->name('flood.index');
    });

    Route::prefix('user')->group(function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('/', 'index')->name('user.management.index');
            Route::post('/store', 'store')->name('user.management.store');
            Route::post('/update', 'update')->name('user.management.update');
            Route::post('/destroy', 'destroy')->name('user.management.destroy');
            Route::get('/edit/{id}', 'edit')->name('user.management.edit');
        });
    });
});

Route::post('/modbus/read', [ModbusController::class, 'publishRead'])->name('modbus.publish-read');
Route::post('/modbus/tcpdump', [ModbusController::class, 'publishTcpdump'])->name('modbus.publish-tcpdump');
Route::post('/modbus/write', [ModbusController::class, 'publishWrite'])->name('modbus.publish-write');
Route::post('/ping/send', [CommandController::class, 'publishPing'])->name('ping.send');
Route::post('/nmap/send', [CommandController::class, 'publishNmap'])->name('nmap.send');
Route::post('/flood/send', [CommandController::class, 'publishFlood'])->name('flood.send');
Route::post('/stop/all', [CommandController::class, 'stopAll'])->name('stop.all');

require __DIR__ . '/auth.php';
