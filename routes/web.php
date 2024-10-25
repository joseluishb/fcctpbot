<?php

use App\Http\Controllers\BotManController;
use App\Http\Controllers\DialogflowController;
use App\Http\Controllers\ProfileController;


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin/menu-options');//return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin/menu-options/{parentId?}', \App\Livewire\Admin\MenuOptions::class)->name('menu-options');
});

Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);
Route::get('/2024-2', function () {
    return view('landing');
});

Route::get('/demo', function () {
    return view('demo');
});

Route::get('/chat', function () {
    return view('chat');
});

Route::post('/q/getTurnoMatricula', [BotManController::class, 'getTurnoMatricula'])->name('turnomatr');

Route::post('/dialogflow/detect-intent', [DialogflowController::class, 'detectIntent'])->name('dialogflow.detectIntent');;


require __DIR__.'/auth.php';
