<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth') -> group(function () {
    Route::get('/dashboard/admin' , [AdminController::class , 'index'])->name('dashboard.admin') ;
    Route::get('/dashboard/categories' , [AdminController::class , 'categoriesShow'])->name('admin.categories') ;
}) ;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function() {

    Route::get('/dashboard',[UserController::class , 'index'] )->name('dashboard'); 
    Route::post('/create/colocation' , [ColocationController::class , 'store']) ->name('create.colocation') ;
    Route::get('/colocation/{colocation}' , [ColocationController::class , 'show']) ->name('colocation.show') ;

    Route::post('/expenses/store' , [ExpenseController::class , 'store'])->name('expenses.store') ;


}) ; 

Route::middleware('auth')->group(function() {

    Route::post('/invitation/store' , [InvitationController::Class , 'store']) -> name('invitation.store') ;
    Route::get('/invitation' , [InvitationController::Class , 'process']) -> name('invitation.show') ;
    Route::post('/invitation' , [InvitationController::class , 'decide']) -> name('invitation.process')  ; 


    Route::post('/settlements/pay' , [InvitationController::class , 'cancel']) -> name('settlements.pay')  ;

    Route::get('/colocation/settings' , [InvitationController::class , 'show']) -> name('colocation.settings')  ;


}) ; 

require __DIR__.'/auth.php';
