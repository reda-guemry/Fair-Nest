<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettlementController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/dashboard/admin', [AdminController::class, 'index'])->name('dashboard.admin');
    Route::patch('/admin/dashboard/users/ban', [AdminController::class, 'banUser'])->name('admin.users.ban');
    Route::patch('/admin/dashboard/users/unban', [AdminController::class, 'unbanUser'])->name('admin.users.unban');
    
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::post('/create/colocation', [ColocationController::class, 'store'])->name('create.colocation');

    Route::post('/expenses/store', [ExpenseController::class, 'store'])->name('expenses.store');


});

Route::middleware(['auth' , 'colocation.mamber'])->group(function () {
    Route::get('/colocation/{colocation}', [ColocationController::class, 'show'])->name('colocation.show');
});

Route::middleware('auth')->group(function () {

    Route::get('/invitation', [InvitationController::class, 'process'])->name('invitation.show');
    Route::post('/invitation', [InvitationController::class, 'decide'])->name('invitation.process');
    Route::post('/settlements/pay', [SettlementController::class, 'paye'])->name('settlements.pay');

});

Route::middleware(['auth', 'colocation.owner'])->group(function () {

    Route::get('/colocation/{colocation}/settings', [ColocationController::class, 'setting'])->name('colocation.settings');
    Route::post('/colocation/{colocation}/settings', [CategorieController::class, 'store'])->name('colocation.categories.store');
    Route::post('/colocation/{colocation}/categories/{category}/modifier', [CategorieController::class, 'modifier'])->name('colocation.categories.update');
    Route::post('/colocation/{colocation}/invitation/store', [InvitationController::class, 'store'])->name('invitation.store');
    Route::post('/colocation/{colocation}/kick/{member}', [ColocationController::class, 'kick'])->name('colocations.kick');
});

require __DIR__ . '/auth.php';
