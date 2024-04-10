<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\AlbumPictureController;
use App\Http\Controllers\PictureController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('/albums/search', [AlbumController::class, 'search'])
        ->name('albums.search');

    Route::resource('albums', AlbumController::class)
        ->except('show');

    Route::post('/albums/{album}/transfer', [AlbumController::class, 'transferAndDestroy'])
        ->name('albums.transfer');

    Route::resource('albums.pictures', AlbumPictureController::class)
        ->only(['index', 'store']);

    Route::get('/pictures/{picture}', [PictureController::class, 'download'])
        ->name('pictures.download');

    Route::resource('pictures', PictureController::class)
        ->only(['update', 'edit', 'destroy']);
});

require __DIR__ . '/auth.php';
