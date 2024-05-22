<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

// Home route displaying the list of books
Route::get('/', [BookController::class, 'index'])->name('home');

// Route to view the import page
Route::get('books/import/view', function () {
    return view('books.import');
})->name('books.import.view');

// Route to display the list of books
Route::get('books', [BookController::class, 'index'])->name('books.index');

// Route to export the books data as a CSV file
Route::get('books/export', [BookController::class, 'export'])->name('books.export');

// Route to import books from a CSV file
Route::post('books/import', [BookController::class, 'import'])->name('books.import');

// Route to generate a QR code for a specific book
Route::get('books/{id}/qrcode', [BookController::class, 'generateQrCode'])->name('books.qrcode');

// Route to display details of a specific book
Route::get('books/{id}', [BookController::class, 'show'])->name('books.show');

// Route to generate a PDF for a specific book
Route::get('books/{id}/pdf', [BookController::class, 'generatePdf'])->name('books.pdf');

// Route to view the QR code page
Route::get('books/qrcode/view', function () {
    return view('books.qrcode');
})->name('books.qrcode.view');
