<?php

use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LeaveManageController;
use App\Http\Controllers\User\LeaveRequestController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if(auth()->check() && auth()->user()->role == 'admin')
        return redirect()->route('admin.dashboard');
    else if(auth()->check() && auth()->user()->role == 'user')
        return redirect()->route('dashboard');

    return redirect()->route('login');
});


//Route::get('/', function () {
//    return view('welcome');
//});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified', 'user'])->group(function () {
    Route::get('/dashboard', [UserController::class,'index'])->name('dashboard');

    Route::get('/leave-request/create', [LeaveRequestController::class,'create'])->name('leave-request.create');
    Route::post('/leave-request', [LeaveRequestController::class,'store'])->name('leave-request.store');
    Route::get('/leave-request/{id}', [LeaveRequestController::class,'show'])->name('leave-request.show');
    Route::get('/leave-request/{id}/edit', [LeaveRequestController::class,'edit'])->name('leave-request.edit');
    Route::put('/leave-request/{id}', [LeaveRequestController::class,'update'])->name('leave-request.update');
    Route::delete('/leave-request/{id}', [LeaveRequestController::class,'destroy'])->name('leave-request.destroy');
});

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [HomeController::class,'index'])->name('admin.dashboard');

    Route::get('/admin/manage-employee', [EmployeeController::class,'index'])->name('admin.manage-employee');
    Route::get('/admin/approve-employee/{id}', [EmployeeController::class,'approveEmployee'])->name('admin.approve-employee');
    Route::get('/admin/block-employee/{id}', [EmployeeController::class,'blockEmployee'])->name('admin.block-employee');
    Route::get('/admin/unblock-employee/{id}', [EmployeeController::class,'unblockEmployee'])->name('admin.unblock-employee');

    Route::get('/admin/manage-leave', [LeaveManageController::class,'index'])->name('admin.manage-leave');
    Route::get('/admin/approve-leave/{id}', [LeaveManageController::class,'approveLeave'])->name('admin.approve-leave');
    Route::get('/admin/reject-leave/{id}', [LeaveManageController::class,'rejectLeave'])->name('admin.reject-leave');

});



require __DIR__.'/auth.php';
