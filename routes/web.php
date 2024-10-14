<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BulletinController; //最新公告模組引入
use App\Http\Controllers\MainCateController;

Route::get('/', function () {
    return view('welcome');
})->name('FontHome');

// Route::get('/Bulletin', function () {
//     return view('Bulletin.Index');
// })->name('ADBulletin');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    
    Route::get('/Admin', function () {
        $user = Auth::user();
        return view('Admin.Index');
    })->middleware('auth')->name('AdHome'); 
});

Route::resource('bulletins', BulletinController::class)->middleware(['auth']);
Route::resource('mainCates', MainCateController::class)->middleware(['auth']);

