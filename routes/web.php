<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LocaleController;

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
    if (Auth::check()) {
        return redirect()->route('tasks.index');
    } else {
        return redirect()->route('login');
    }
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    // Маршрут для відображення форми додавання нового завдання
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');

    // Маршрут для збереження нового завдання
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

    // Маршрути для редагування і видалення завдання
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'remove'])->name('tasks.remove');

    // Маршрут зміни мови
    Route::post('set-locale/{locale}', [LocaleController::class, 'setLocale'])->name('set.locale');
});


