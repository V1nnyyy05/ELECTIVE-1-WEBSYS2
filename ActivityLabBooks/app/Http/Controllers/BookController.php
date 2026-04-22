<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function create()
    {  
        return view("books.create");
    }

    
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'published_year' => 'required|date' 
    ]);

    Book::create([
        'title' => $request->title,
        'author' => $request->author,
        'published_year' => date('Y', strtotime($request->published_year)),
    ]);

    return redirect()->route('books.index')->with('success', 'Book added!');
}

public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'published_year' => 'required|date'
    ]);

    $book = Book::findOrFail($id);
    
    $book->update([
        'title' => $request->title,
        'author' => $request->author,
        'published_year' => date('Y', strtotime($request->published_year)),
    ]);

    return redirect()->route('books.index')->with('success', 'Book updated successfully!');
}

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted!');
    }
}