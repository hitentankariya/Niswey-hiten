<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ImportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('contacts', ContactController::class);

Route::get('import', [ImportController::class, 'importForm'])->name('contacts.import');
Route::post('importpost', [ImportController::class, 'import'])->name('contacts.importpost');