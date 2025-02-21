<?php

use App\Http\Controllers\DeckController;
use App\Http\Controllers\CardController;
use Illuminate\Support\Facades\Route;


Route::apiResource('decks', DeckController::class);
Route::apiResource('cards', CardController::class);