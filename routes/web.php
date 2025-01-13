<?php
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/attendances', [AttendanceController::class, 'index'])->name('attendances.index');
    Route::post('/check-in', [AttendanceController::class, 'checkIn'])->name('attendances.checkIn');
    Route::post('/check-out', [AttendanceController::class, 'checkOut'])->name('attendances.checkOut');
});

require __DIR__.'/auth.php';
