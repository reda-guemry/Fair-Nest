<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettlementController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth' , 'banned'])->group(function () {

    // profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // dashboard routes
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::post('/create/colocation', [ColocationController::class, 'store'])->name('create.colocation');
    Route::post('/expenses/store', [ExpenseController::class, 'store'])->name('expenses.store');

    // invitation routes
    Route::get('/invitation', [InvitationController::class, 'process'])->name('invitation.show');
    Route::post('/invitation', [InvitationController::class, 'decide'])->name('invitation.process');

    // settlements routes
    Route::post('/settlements/pay', [SettlementController::class, 'paye'])->name('settlements.pay');

    // colocation member routes
    Route::middleware(['colocation.mamber'])->group(function () {
        Route::get('/colocation/{colocation}', [ColocationController::class, 'show'])->name('colocation.show');
        Route::post('/colocation/{colocation}/leave', [ColocationController::class, 'leaveColocation'])->name('colocation.leave');
        Route::get('/colocation/{colocation}/message', [MessageController::class, 'index'])->name('colocation.chat');
        Route::post('/colocation/{colocation}/message/send', [MessageController::class, 'store'])->name('colocation.chat.send');
    });

    // colocation owner routes
    Route::middleware(['colocation.owner'])->group(function () {

        Route::get('/colocation/{colocation}/settings', [ColocationController::class, 'setting'])->name('colocation.settings');
        Route::post('/colocation/{colocation}/settings', [CategorieController::class, 'store'])->name('colocation.categories.store');
        Route::post('/colocation/{colocation}/categories/{category}/modifier', [CategorieController::class, 'modifier'])->name('colocation.categories.update');
        Route::post('/colocation/{colocation}/invitation/store', [InvitationController::class, 'store'])->name('invitation.store');
        Route::post('/colocation/{colocation}/kick/{member}', [ColocationController::class, 'kick'])->name('colocations.kick');
        Route::delete('/colocation/{colocation}/delete', [ColocationController::class, 'delete'])->name('colocation.destroy');

    });

    // admin routes
    Route::middleware(['admin'])->group(function () {

        Route::get('/dashboard/admin', [AdminController::class, 'index'])->name('dashboard.admin');
        Route::patch('/admin/dashboard/users/ban', [AdminController::class, 'banUser'])->name('admin.users.ban');
        Route::patch('/admin/dashboard/users/unban', [AdminController::class, 'unbanUser'])->name('admin.users.unban');
        Route::get('/admin/dashboard/transferownership/{colocation}', [AdminController::class, 'colocationUsers'])->name('transfer.ownership');
        Route::patch('/admin/dashboard/transferownership/{colocation}', [AdminController::class, 'transferOwnership'])->name('colocation.transfer-ownership');

    });

});

require __DIR__.'/auth.php';
