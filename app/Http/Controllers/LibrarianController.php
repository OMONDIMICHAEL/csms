<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Communication;
use App\Models\Book;
use App\Models\BookTransaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LibrarianController extends Controller
{
  public function index()
  {
      return view('librarian.librarian_dashboard');
  }
  public function showCommunications()
  {
      $communications = Communication::latest()->limit(5)->get();
      return view('librarian.librarian_communication', compact('communications'));
  }
  // Show available books & issued books
    public function showIndex()
    {
        $books = Book::all();
        $transactions = BookTransaction::where('student_id', Auth::id())->where('status', 'issued')->with('book')->get();
        //
        return view('librarian.index', compact('books', 'transactions'));
        // $books = Book::where('available_copies', '>', 0)->get();
        // return view('librarian.index', compact('books'));
    }

    // Issue a book
    public function issueBook(Request $request, Book $book)
    {
        if ($book->available_copies <= 0) {
            return back()->with('error', 'No copies available for this book.');
        }

        BookTransaction::create([
            'student_id' => Auth::id(),
            'book_id' => $book->id,
            'issued_at' => now(),
            'due_date' => now()->addDays(14), // Due in 2 weeks
            'status' => 'issued',
        ]);

        $book->decrement('available_copies');

        return back()->with('success', 'Book issued successfully.');
    }

    // Return a book
    // public function returnBook(BookTransaction $transaction)
    // {
    //     $transaction->update([
    //         'returned_at' => now(),
    //         'status' => 'returned',
    //     ]);
    //
    //     $transaction->book->increment('available_copies');
    //
    //     return back()->with('success', 'Book returned successfully.');
    // }
    // Show form to add a new book (for librarian)
    public function create()
    {
        return view('librarian.create');
    }

    // Store book details
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books',
            'total_copies' => 'required|integer|min:1',
        ]);
        try{

        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'isbn' => $request->isbn,
            'total_copies' => $request->total_copies,
            'available_copies' => $request->total_copies,
        ]);

        return redirect()->route('librarian.borrowed')->with('success', 'Book added successfully.');
    } catch (\Exception $e) {
        // Log the error
      Log::error('Error uploading book: ' . $e->getMessage(), [
          'exception' => $e,
          'trace' => $e->getTraceAsString(),
      ]);

      // Return with an error message and details
      return back()->with('error', 'Failed to upload book. Error: ' . $e->getMessage());
    }
}
    //  Student borrows a book
   public function borrowBook($book_id)
   {
       $book = Book::findOrFail($book_id);

       if ($book->available_copies < 1) {
           return back()->with('error', 'This book is not available for borrowing.');
       }

       BookTransaction::create([
           'student_id' => Auth::id(),
           'book_id' => $book->id,
           'issued_at' => now(),
           'due_date' => now()->addDays(14), // 2 weeks borrowing period
           'status' => 'issued',
       ]);

       $book->decrement('available_copies'); // Reduce available copies

       return back()->with('success', 'Book borrowed successfully.');
   }
   //  Librarian views borrowed books
    public function borrowedBooks()
    {
        $transactions = BookTransaction::where('status', 'issued')->with('book', 'student')->get();
        return view('librarian.borrowed', compact('transactions'));
    }

    //  Librarian returns a book
    public function returnBook($transaction_id)
    {
        $transaction = BookTransaction::findOrFail($transaction_id);

        $transaction->update(['status' => 'returned']);

        $transaction->book->increment('available_copies'); // Increase available copies

        return back()->with('success', 'Book returned successfully.');
    }
}
