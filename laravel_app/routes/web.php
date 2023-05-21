<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\User;

use Illuminate\Pagination\Paginator;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/viewitems', function() {

    $user = user::paginate(5);

    return view('viewdetails',compact('user'));
});

Route::get('add-user',[ProfileController::class,'adduser']);

Route::post('save-user',[ProfileController::class,'saveuser']);

Route::get('edit-student/{id}',[ProfileController::class,'editstudent']);


Route::post('update-user',[ProfileController::class,'updateuser']);

Route::delete('delete-student/{id}',[ProfileController::class,'destroyrecord']);

Route::get('/search',[ProfileController::class,'searchemail']);
// Route::post('/deleterecord',[ProfileController::class,'deleterecord'])->name('delete.country');

require __DIR__.'/auth.php';
