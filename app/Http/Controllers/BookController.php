<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BooksExport;
use App\Imports\BooksImport;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::orderBy('id')->get();
        return view('books.index', [
            'books' => $books
        ]);
    }

    public function export()
    {
        return Excel::download(new BooksExport, 'books.csv');
    }

    public function import(Request $request)
    {
        // Validate the request
        $request->validate([
            'file' => 'required|file|mimes:csv,txt'
        ]);

        // Import the file
        Excel::import(new BooksImport, $request->file('file'));

        return back()->with('success', 'Books imported successfully.');
    }

    public function generateQrCode($id)
    {
        $book = Book::findOrFail($id);
        
        // Serialize book data
        $bookData = json_encode([
            'title' => $book->title,
            'author' => $book->author,
            'isbn' => $book->isbn
        ]);
        
        // Generate QR code containing serialized book data
        $qrCode = QrCode::size(200)->generate($bookData);
        
        // Return the view with both book details and QR code
        return view('books.show', compact('book', 'qrCode'));
    }

    public function generatePdf($id)
    {
        $book = Book::findOrFail($id);
        
        // Serialize book data
        $bookData = json_encode([
            'title' => $book->title,
            'author' => $book->author,
            'isbn' => $book->isbn
        ]);
        
        // Generate QR code containing serialized book data
        $qrCode = QrCode::size(200)->generate($bookData);
        
        // Load the PDF view with both book details and QR code
        $pdf = Pdf::loadView('books.pdf', compact('book', 'qrCode'));
        
        // Return the PDF download response
        return $pdf->download('books.pdf');
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('books.show', compact('book'));
    }
}
