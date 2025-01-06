<?php


use App\Http\Controllers\Admin\Assets\AdminBondController;
use App\Http\Controllers\Admin\Assets\AdminStockController;
use Illuminate\Support\Facades\Route;


Route::post('stocks-pdf-export', [AdminStockController::class, 'pdf_export'])->name('stock_pdf_export');
Route::get('stocks-pdf-export-download', [AdminStockController::class, 'downloadPdfExport'])->name('download_stock_pdf_export');

Route::post('bond-pdf-export', [AdminBondController::class, 'pdf_export'])->name('bond_pdf_export');
Route::get('bond-pdf-export-download', [AdminBondController::class, 'downloadPdfExport'])->name('download_bond_pdf_export');






