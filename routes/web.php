<?php

use App\Http\Controllers\MedicineController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IdMerkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\YourProfileController;
use App\Http\Controllers\userdatacontroller;
use App\Http\Controllers\addusercontroller;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StockController;

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

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

Route::controller(ProfileController::class)->group(function() {
    Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('profile', [ProfileController::class, 'changeProfile'])->name('profile.change');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/change-password', [ChangePasswordController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/change-password', [ChangePasswordController::class, 'updatePassword'])->name('password.update');
});

Route::prefix('/medicine')->name('medicine.')->group(function() {
    Route::get('/create', [MedicineController::class, 'create'])->name('create');
    Route::post('/store', [MedicineController::class, 'store'])->name('store');
    Route::get('/', [MedicineController::class, 'index'])->name('home');
    Route::get('/{id}', [MedicineController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [MedicineController::class, 'update'])->name('update');
    Route::delete('/{id}', [MedicineController::class, 'destroy'])->name('delete');
});

Route::prefix('/id_merk')->name('merk.')->group(function() {
    Route::get('/', [IdMerkController::class, 'index'])->name('home');
    Route::get('/create', [IdMerkController::class, 'create'])->name('create');
    Route::post('/store', [IdMerkController::class, 'store'])->name('store');
    Route::get('{id_merk}', [IdMerkController::class, 'edit'])->name('edit');
    Route::patch('{id_merk}', [IdMerkController::class, 'update'])->name('update');
    Route::delete('{id_merk}', [IdMerkController::class, 'destroy'])->name('delete');
    Route::patch('/updateStatus/{id_merk}', [IdMerkController::class, 'updateStatus'])->name('updateStatus');
});


Route::get('/your-profile', [YourProfileController::class, 'show'])->name('your-profile');
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/your-profile', [YourProfileController::class, 'show'])->name('your-profile');
    Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
    Route::get('adduser',[addusercontroller::class,'adduser'])->name('addUser');
    Route::post('adduser',[addusercontroller::class,'adduserSave'])->name('adduser,Save');
    Route::get('/stock',[StockController::class,'stock'])->name('stock');
    Route::get('/',[OrderController::class,'index'])->name('index');
    Route::get('/create',[OrderController::class,'create'])->name('create');
    Route::post('/store',[OrderController::class,'store'])->name('store');
    Route::get('/print/{id}', [OrderController::class, 'show'])->name('print');
    Route::get('/download/{id}', [OrderController::class, 'downloadPDF'])->name('download');


