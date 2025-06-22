<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolPartnerController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::view('/login', 'login')->name('login');
Route::view('/register', 'registration')->name('register');
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login')->with('success', 'You have been logged out.');
})->name('logout');
Route::middleware(['check.jwt'])->group(function () {
    Route::get('/school-partners/export', [SchoolPartnerController::class, 'export'])->name('school-partners.export');
    Route::resource('school-partners', SchoolPartnerController::class);
});
