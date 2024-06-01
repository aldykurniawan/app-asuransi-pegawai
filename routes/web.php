<?php

use App\Http\Controllers\DashboardController;
// use App\Http\Controllers\DataMaster\RolesController;
use App\Http\Controllers\DataMaster\StatikDataController;
use App\Http\Controllers\DataMaster\UsersController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Fe\IndexController;
use App\Http\Controllers\InsurancePolicyController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Support\AdditionalController;
// use Illuminate\Foundation\Application;
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

Route::get('file/{path}', [AdditionalController::class, 'generateUrl'])
    ->where('path', '.*')
    ->name('file.preview');

Route::name('fe.')->group(function () {
    Route::controller(IndexController::class)->group(function () {
        Route::get('/', 'index')->name('index');
    });
});

Route::middleware('auth')->group(function () {
    Route::prefix('app')->group(function () {
        //dashboard
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('kasir-app', [DashboardController::class, 'kasir'])->name('kasir');
        //barangs
        Route::get('barangs', [DashboardController::class, 'barangs'])->name('barangs');
        //riwayatTransaksi
        Route::get('riwayatTransaksi', [DashboardController::class, 'riwayatTransaksi'])->name('riwayatTransaksi');
        // printStruk
        Route::get('printStruk/{id}', [DashboardController::class, 'printStruk'])->name('printStruk');
        //storePembelian
        Route::post('storePembelian', [DashboardController::class, 'storePembelian'])->name('storePembelian');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

        Route::resources([
            'pegawais'  => EmployeeController::class,
            'asuransis' => InsurancePolicyController::class,
        ]);

        Route::controller(NotificationController::class)->name('notification.')->prefix('dashboard/notification')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/get-data', 'getUserNotification')->name('get-data');
            Route::get('/mark-as-read/{id}', 'markAsRead')->name('mark-as-read');
        });

        Route::group(['prefix' => 'data-master', 'middleware' => ['role:superadmin|admin']], function () {
            Route::name('master.')->group(function () {
                Route::resources([
                    // 'roles'   => RolesController::class,
                    'users' => UsersController::class,
                ]);

                // statik-data
                Route::get('statikapp', [StatikDataController::class, 'showEgap'])->name('statikapp.show');
                // show showEgapData
                Route::get('statikapp-data', [StatikDataController::class, 'showEgapData'])->name('statikapp.data');
                // store
                Route::post('statikapp-store', [StatikDataController::class, 'store'])->name('statikapp.store');

                // textarea
                Route::post('store-image-app', [AdditionalController::class, 'storeImage'])->name('store-image-app');
                // dropzone
                Route::post('store-image-app-multiple', [AdditionalController::class, 'storeImageMultiple'])->name('store-image-app-multiple');
                // removeFile
                Route::post('remove-file/{id}/{folder}', [AdditionalController::class, 'removeFile'])->name('remove-file');
            });
        });
    });
});

require __DIR__.'/auth.php';
