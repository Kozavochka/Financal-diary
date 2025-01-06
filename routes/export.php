<?php


use App\Http\Controllers\Admin\Assets\AdminBondController;
use App\Http\Controllers\Admin\Assets\AdminStockController;
use App\Http\Controllers\Admin\Statistic\StatisticController;
use Illuminate\Support\Facades\Route;


Route::post('stocks-pdf-export', [AdminStockController::class, 'pdf_export'])->name('stock_pdf_export');
Route::get('stocks-pdf-export-download', [AdminStockController::class, 'downloadPdfExport'])->name('download_stock_pdf_export');

Route::post('bond-pdf-export', [AdminBondController::class, 'pdf_export'])->name('bond_pdf_export');
Route::get('bond-pdf-export-download', [AdminBondController::class, 'downloadPdfExport'])->name('download_bond_pdf_export');

Route::post('total-pdf-export', [StatisticController::class, 'exportTotalPdf'])->name('total_pdf_export');
Route::get('total-pdf-export-download', [StatisticController::class, 'downloadTotalPdfExport'])->name('download_total_pdf_export');






