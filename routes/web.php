<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
  return redirect('/dashboard');
});
Route::middleware(['auth', 'verified'])->controller(ChatController::class)->group(function () {
  Route::get('/dashboard', 'index')->name('dashboard');
  Route::get('/dashboard/{id}', 'chat')->name('chat');
  Route::get('/messages', 'messages');
  Route::post('/chat', 'create')->name('chat.create');
  Route::post('/send', 'send');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
