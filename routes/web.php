<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\ReservationController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/monuments/{id}', [HomeController::class, 'showMonument'])->name('monuments.show');
Route::get('/chatbot-guide', function() {
    return view('chatbot');
})->name('chatbot.index');

Route::post('/api/chatbot', [ChatbotController::class, 'handleChat']);
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
