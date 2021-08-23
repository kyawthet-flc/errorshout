<?php 

use Illuminate\Support\Facades\Route;
use Kyawthet\ErrorShout\Http\Controllers\NotifyController;

Route::get('notifies', [NotifyController::class, 'index'])->name('notifies.index');
Route::get('notifies/{notify}', [NotifyController::class, 'show'])->name('notifies.show');
Route::post('notifies/{notify}', [NotifyController::class, 'edit'])->name('notifies.edit');
Route::put('notifies/{notify}', [NotifyController::class, 'update'])->name('notifies.update');