<?php

declare(strict_types=1);

use App\Http\Controllers\Tenant\ProfileController;
use Illuminate\Support\Facades\Route;
/* use Stancl\Tenancy\Middleware\InitializeTenancyByDomain; */
use Stancl\Tenancy\Middleware\InitializeTenancyByDomainOrSubdomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomainOrSubdomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        /* dd(\App\Models\User::all()); */
        /* return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id'); */
        return view('tenant.welcome');
    });

    Route::group([
        'middleware' => ['auth', 'verified'],
        'prefix'    =>  'web-admin',
    ], function() {
    
        Route::get('/', function() {
            return redirect(route('ten.dashboard'));
        });
    
        Route::get('/dashboard', function () {
            return view('tenant.backend.dashboard');
        })->name('ten.dashboard');

        Route::get('/setting', function () {
            return view('tenant.backend.setting');
        })->name('ten.setting');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('ten.profile.edit');
        Route::get('/profile/update-password', [ProfileController::class, 'editPass'])->name('ten.profile.pass.edit');
        Route::get('/profile/delete-account', [ProfileController::class, 'editDel'])->name('ten.profile.del.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('ten.profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('ten.profile.destroy');
    
    });

    require __DIR__.'/tenantAuth.php';

});