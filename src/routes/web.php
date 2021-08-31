<?php 

use Illuminate\Support\Facades\Route;
use Kyawthet\ErrorShout\Http\Controllers\NotifyController;

Route::prefix('errorshout')->name('errorshout.notifies.')->middleware(['web'])->group(function () {

    Route::get('notifies', [NotifyController::class, 'index'])->name('index');
    Route::get('notifies/fix/{notify}', [NotifyController::class, 'fix'])->name('fix');

});