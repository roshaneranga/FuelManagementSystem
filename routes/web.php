<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController; // Make sure this line is present
use App\Http\Controllers\FuelEntryController; // And this one
use App\Http\Controllers\ReportController; // And this one

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Change this line:
Route::get('/', [VehicleController::class, 'index'])->name('home');
// OR if you prefer to redirect to the vehicles index:
// Route::get('/', function () {
//     return redirect()->route('vehicles.index');
// });


Route::resource('vehicles', VehicleController::class);
Route::get('/vehicles/get-fuel-type/{id}', [VehicleController::class, 'getFuelType'])->name('vehicles.getFuelType');

Route::resource('fuel-entries', FuelEntryController::class);

Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');