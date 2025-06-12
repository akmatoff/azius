<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $locale = session('locale', 'ru');
    return redirect($locale);
});

Route::group(['prefix' => '{locale}', 'where' => ['locale' => 'en|ru']], function () {
    Route::get('/', function () {
        return view('landing');
    })->name('home');
});



Route::get('/work/{slug}', function () {
    return view('work');
});

Route::get('/admin', function () {
    return view('admin');
})->middleware(['auth', 'verified'])->name('admin');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
