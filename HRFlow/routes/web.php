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

Route::get('/carrieres', [CarriereController::class, 'index'])->name('carrieres.index');
Route::get('/carrieres/create', [CarriereController::class, 'create'])->name('carrieres.create');
Route::post('/carrieres', [CarriereController::class, 'store'])->name('carrieres.store');
Route::get('/carrieres/{carriere}', [CarriereController::class, 'show'])->name('carrieres.show');

Route::get('/users/{user}/carrieres', [CarriereController::class, 'userCarrieres'])->name('users.carrieres');

Route::get('/posts-by-department/{departmentId}', [CarriereController::class, 'getPostsByDepartment'])->name('posts.by.department');

Route::get('formations/{formation}/users', [FormationController::class, 'showUsers'])->name('formations.users');

Route::resource('formations', FormationController::class);

Route::resource('documents', DocumentController::class);

Route::get('/get-posts/{departmentId}', [UserController::class, 'getPostsByDepartment']);

Route::resource('users', UserController::class);

Route::resource('grades', GradeController::class);

Route::resource('contracts', ContractController::class);

Route::resource('posts', PostController::class);

Route::resource('employees', EmployeeController::class);

Route::resource('departments', DepartmentController::class);

// Route::middleware([CheckRole::class.':admin'])->group(function () {
    Route::get('/admin/roles-permissions', [RolePermissionController::class, 'index'])->name('admin.roles_permissions.index')->middleware('role:admin');
    Route::post('/admin/roles', [RolePermissionController::class, 'storeRole'])->name('admin.roles.store');
    Route::post('/admin/permissions', [RolePermissionController::class, 'storePermission'])->name('admin.permissions.store');
    Route::delete('admin/roles/{id}', [RolePermissionController::class, 'destroyRole'])->name('admin.roles.destroy');
    Route::delete('admin/permissions/{id}', [RolePermissionController::class, 'destroyPermission'])->name('admin.permissions.destroy');
// });

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

require __DIR__.'/auth.php';
