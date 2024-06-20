<?php

use App\Models\SapM\Cliente;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BotManController;

Route::get('/', function () {
    return view('welcome');
});

Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);

Route::get('/cliente', function () {
    $nroDoc = '74233592';

    $cliente = Cliente::where('dni', $nroDoc)->first();


});

Route::get('/demo', function () {
    return view('demo');
});
