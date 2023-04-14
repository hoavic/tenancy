<?php

use App\Http\Controllers\Admin\AccountsController;
use App\Http\Controllers\Admin\CustomersController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Client\ImpersonateController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('guest.home');
})->name('home');


// by Prefix
Route::group([
    'prefix' => 'ai-client',
], function() {

    // by Middleware
    Route::group([
        'middleware' => 'auth',
    
    ], function() {
    
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::get('/profile/update-password', [ProfileController::class, 'editPass'])->name('profile.pass.edit');
        Route::get('/profile/delete-account', [ProfileController::class, 'editDel'])->name('profile.del.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        
    });

    Route::group([
        'middleware' => ['auth', 'verified'],
    
    ], function() {

        Route::get('/quick-login', [ImpersonateController::class, 'index']);
    
        Route::get('/', function() {
            return redirect(route('client.dashboard'));
        });
    
        Route::get('/dashboard', function () {
            return view('client.dashboard');
        })->name('client.dashboard');
    
        Route::get('/setting', function() {
            return view('client.setting');
        })->name('client.setting');
    
        Route::resource('projects', ProjectController::class, [
            'names' => [
                'index' => 'client.projects.index',
                'store' => 'client.projects.store',
                'edit' => 'client.projects.edit', 
                'update' => 'client.projects.update', 
                'destroy' => 'client.projects.destroy'
            ]
        ]);
    
    });
    
});

Route::group([
    'prefix' => 'ai-admin',
    'middleware' => ['auth', 'verified', 'role:Super Admin|Admin|Manager'],
], function() {

    Route::get('/', function() {
        return redirect(route('admin.dashboard'));
    });

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::resource('roles', RolesController::class, [
        'names' => [
            'index' => 'admin.roles.index',
            'store' => 'admin.roles.store',
            'edit' => 'admin.roles.edit', 
            'update' => 'admin.roles.update', 
            'destroy' => 'admin.roles.destroy'
        ]
    ]);

    Route::resource('permissions', PermissionsController::class, [
        'names' => [
            'index' => 'admin.permissions.index', 
            'store' => 'admin.permissions.store', 
            'edit' => 'admin.permissions.edit', 
            'update' => 'admin.permissions.update', 
            'destroy' => 'admin.permissions.destroy'
        ]
    ]);

    Route::resource('plans', PlanController::class, [
        'names' => [
            'index' => 'admin.plans.index',
            'store' => 'admin.plans.store',
            'edit' => 'admin.plans.edit', 
            'update' => 'admin.plans.update', 
            'destroy' => 'admin.plans.destroy'
        ]
    ]);

    Route::resource('customer-manager', CustomersController::class, [
        'names' => [
            'index' => 'admin.customer-manager.index', 
            'store' => 'admin.customer-manager.store', 
            'edit' => 'admin.customer-manager.edit', 
            'update' => 'admin.customer-manager.update', 
            'destroy' => 'admin.customer-manager.destroy'
        ]
    ]);

    Route::resource('accounts', AccountsController::class, [
        'names' => [
            'index' => 'admin.accounts.index', 
            'store' => 'admin.accounts.store', 
            'edit' => 'admin.accounts.edit', 
            'update' => 'admin.accounts.update', 
            'destroy' => 'admin.accounts.destroy'
        ]
    ]);
    

    
});


require __DIR__.'/auth.php';
