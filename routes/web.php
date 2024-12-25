<?php

use App\Http\Controllers\blog\BlogController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\PermissionController;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\TagController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\LanguagePrefixMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UserAccessDashboardMiddleware;
use App\Jobs\SendWelcomeEmail;
use App\Jobs\TestJob;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App as AppLaravel;

//*Region y localizacion*//
// echo AppLaravel::currentLocale();
// Route::get('set_locale/{locale}', function(string $locale) {
//     if(!in_array($locale, ['en', 'es'])){
//         abort(400);
//     }
//     AppLaravel::setLocale($locale);
// });

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/vue/{n1?}/{n2?}/{n3?}', function () {
//     return view('vue');
// });

// //Route::post('user/login',[LoginController::class, 'authenticate']);

// Route::get('/vue/save', function () {
//     return view('save');
// });

//* Lazy loading */
// DB::listen(function($query) {
//     echo $query->sql;
// });


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', UserAccessDashboardMiddleware::class]], function () {
    Route::resources([
        'post' => PostController::class,
        'tag' => TagController::class,
        'category' => CategoryController::class,
        'role' => RoleController::class,
        'permission' => PermissionController::class,
        'user' => UserController::class
    ]);
    //roles- permisos
    Route::post('role/assign/permission/{role}', [App\View\Components\Dashboard\role\permission\Manage::class, 'handle'])->name('role.assign.permission');
    Route::delete('role/delete/permission/{role}', [App\View\Components\Dashboard\role\permission\Manage::class, 'delete'])->name('role.delete.permission');
    Route::post('role/delete/permission/{role}', [App\View\Components\Dashboard\role\permission\Manage::class, 'delete'])->name('role.delete.permission');

    //-- users- roles
    Route::post('user/assign/role/{user}', [App\View\Components\Dashboard\user\role\permission\Manage::class, 'handleRole'])->name('user.assign.role');
    Route::delete('user/delete/role/{user}', [App\View\Components\Dashboard\user\role\permission\Manage::class, 'deleteRole'])->name('user.delete.role');
    Route::post('user/delete/role/{user}', [App\View\Components\Dashboard\user\role\permission\Manage::class, 'deleteRole'])->name('user.delete.role');
    //permissions
    Route::post('user/assign/permission/{user}', [App\View\Components\Dashboard\user\role\permission\Manage::class, 'handlePermission'])->name('user.assign.permission');
    Route::delete('user/delete/permission/{user}', [App\View\Components\Dashboard\user\role\permission\Manage::class, 'deletePermission'])->name('user.delete.permission');
    Route::post('user/delete/permission/{user}', [App\View\Components\Dashboard\user\role\permission\Manage::class, 'deletePermission'])->name('user.delete.permission');

    Route::get('', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');
});
Route::group(['prefix' => '{locale}/blog', 'middleware' => LanguagePrefixMiddleware::class], function () {
// Route::group(['prefix' => 'blog', 'middleware' => LanguagePrefixMiddleware::class], function () {
    Route::get('', [BlogController::class, 'index']);
    Route::get('detail/{id}', [BlogController::class, 'show'])->name('blog.show');
    //Route::get('detail/{post}', [BlogController::class, 'show'])->name('blog.show');
});

Route::get('test-job', function(){
    TestJob::dispatch();
    return 'vista';
});

//*Queues and jobs
Route::get('test-webe', function(){
    SendWelcomeEmail::dispatch();
    return 'vista';
});

// Route::get('/', function() {
//     return ['Laravel' => app()->version()];
// });

require __DIR__ . '/auth.php';
