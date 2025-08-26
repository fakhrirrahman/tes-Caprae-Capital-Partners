<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadController;


Route::get('/', [LeadController::class, 'index'])->name('leads.index');
Route::post('leads', [LeadController::class, 'store'])->name('leads.store');
Route::get('export-csv', [LeadController::class, 'exportCsv'])->name('leads.export');
