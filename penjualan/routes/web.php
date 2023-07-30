<?php

use App\Http\Controllers\PenjualanController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PenjualanController::class, 'index']);
Route::post('/penjualan', [PenjualanController::class, 'store'])->name('penjualan.store');

Route::get('/penjualan/{id}/edit', 'PenjualanController@edit')->name('penjualan.edit');
Route::put('/penjualan/{id}', 'PenjualanController@update')->name('penjualan.update');
Route::delete('/penjualan/{id}', 'PenjualanController@destroy')->name('penjualan.destroy');

Route::get('/', 'PenjualanController@index')->name('penjualan.index');
