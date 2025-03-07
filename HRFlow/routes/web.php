<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\CarriereController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CongeController;
use App\Http\Controllers\HierarchyController;
use App\Http\Controllers\RecoveryController;

Route::middleware(['auth'])->group(function () {
    Route::get('/recoveries', [RecoveryController::class, 'index'])->middleware('can:manage recoveries')->name('recoveries.index');  
    Route::get('/my-recoveries', [RecoveryController::class, 'myRecoveries'])->middleware('can:voir my recoveries')->name('recoveries.myRecoveries'); 
    Route::get('/recoveries/create', [RecoveryController::class, 'create'])->middleware('can:voir my recoveries')->name('recoveries.create'); 
    Route::post('/recoveries', [RecoveryController::class, 'store'])->middleware('can:voir my recoveries')->name('recoveries.store');  

    Route::post('/recoveries/{id}/approve', [RecoveryController::class, 'approveByRh'])->middleware('can:manage recoveries')->name('recoveries.approveByRh');
    Route::post('/recoveries/{id}/reject', [RecoveryController::class, 'rejectByRh'])->middleware('can:manage recoveries')->name('recoveries.rejectByRh');
});

Route::get('/hierarchy', [HierarchyController::class, 'index'])->name('hierarchy.index');

Route::get('carrieres/{carriere}/edit', [CarriereController::class, 'edit'])->middleware('can:manage careers')->name('carrieres.edit');

Route::put('carrieres/{carriere}', [CarriereController::class, 'update'])->middleware('can:manage careers')->name('carrieres.update');

Route::get('admin/roles/{role}/edit', [RolePermissionController::class, 'editRole'])->middleware('role:admin')->name('admin.roles.edit');

Route::put('admin/roles/{role}', [RolePermissionController::class, 'updateRole'])->middleware('role:admin')->name('admin.roles.update');

Route::get('/conges', [CongeController::class, 'index'])->middleware('can:manage conges')->name('conges.index');
Route::middleware('auth')->group(function () {
    Route::get('/conges/create', [CongeController::class, 'create'])->name('conges.create');
    Route::post('/conges', [CongeController::class, 'store'])->name('conges.store');
    Route::get('/mesconges', [CongeController::class, 'myconges'])->name('conges.mesconges');
});

Route::post('/conge/approve/manager/{id}', [CongeController::class, 'approveByManager'])->middleware('role:manager')->name('conge.approve.manager');
Route::post('/conge/approve/rh/{id}', [CongeController::class, 'approveByRh'])->middleware('role:RH')->name('conge.approve.rh');
Route::post('/conge/reject/{id}', [CongeController::class, 'rejectConge'])->middleware('can:manage conges')->name('conge.reject');


Route::get('/carrieres', [CarriereController::class, 'index'])->name('carrieres.index');
Route::get('/carrieres/create', [CarriereController::class, 'create'])->name('carrieres.create')->middleware('can:suivi carriere');
Route::post('/carrieres', [CarriereController::class, 'store'])->name('carrieres.store')->middleware('can:suivi carriere');
Route::get('/carrieres/{carriere}', [CarriereController::class, 'show'])->name('carrieres.show');

Route::get('/users/{user}/carrieres', [CarriereController::class, 'userCarrieres'])->name('users.carrieres');

Route::get('/posts-by-department/{departmentId}', [CarriereController::class, 'getPostsByDepartment'])->name('posts.by.department');

Route::get('formations/{formation}/users', [FormationController::class, 'showUsers'])->name('formations.users');

Route::resource('formations', FormationController::class)->middleware(['auth', 'verified']);

Route::resource('documents', DocumentController::class)->middleware(['auth', 'verified']);

Route::get('/get-posts/{departmentId}', [UserController::class, 'getPostsByDepartment']);

Route::resource('users', UserController::class)->middleware(['auth', 'verified']);

Route::resource('grades', GradeController::class)->middleware(['auth', 'verified']);

Route::resource('contracts', ContractController::class)->middleware(['auth', 'verified']);

Route::resource('posts', PostController::class)->middleware(['auth', 'verified']);

Route::resource('employees', EmployeeController::class)->middleware(['auth', 'verified']);

Route::resource('departments', DepartmentController::class)->middleware(['auth', 'verified']);

Route::get('/admin/roles-permissions', [RolePermissionController::class, 'index'])->name('admin.roles_permissions.index')->middleware('role:admin');
Route::post('/admin/roles', [RolePermissionController::class, 'storeRole'])->name('admin.roles.store')->middleware('role:admin');
Route::post('/admin/permissions', [RolePermissionController::class, 'storePermission'])->name('admin.permissions.store')->middleware('role:admin');
Route::delete('admin/roles/{id}', [RolePermissionController::class, 'destroyRole'])->name('admin.roles.destroy')->middleware('role:admin');
Route::delete('admin/permissions/{id}', [RolePermissionController::class, 'destroyPermission'])->name('admin.permissions.destroy')->middleware('role:admin');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
