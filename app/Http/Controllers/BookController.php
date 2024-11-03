<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $books = Book::latest()->paginate(10);
        return view('book.index', compact('books'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $authors = Author::all();
        return view('book.create')->with('authors', $authors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $authors = Author::all();
        return $this->validate($request, [
            'title' => 'required|string|max:255',
            'year' => 'required|date_format:Y',
            'authors' => 'required|array|min:1',
            'authors.*' => 'required|numeric',
        ], function ($validator, $authors) {
            return redirect()->route('book.create')
                ->withErrors($validator)
                ->with('authors', $authors);
        }, function ($request) {
            $book = Book::create([
                'title' => $request->get('title'),
                'year' => $request->get('year')
            ]);
            array_map(function ($author) use ($book) {
                $book->authors()->attach($author);
            }, $request->get('authors'));

            return redirect()->route('book.index')
                ->with('success', 'Book created successfully.')
                ->with('book', $book);
        }, [$authors]);
    }

    /**
     * Display the specified resource.
     */
    public
    function show(Book $book): View
    {
        return view('book.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public
    function edit(Book $book): View
    {
        $authors = Author::all();
        $selectedAuthors = array_map(fn($item) => $item['id'], $book->authors->toArray());
        return view('book.edit', compact('book'))
            ->with('authors', $authors)
            ->with('selectedAuthors', $selectedAuthors);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book): RedirectResponse
    {
        $authors = Author::all();
        return $this->validate($request, [
            'title' => 'required|string|max:255',
            'year' => 'required|date_format:Y',
            'authors' => 'required|array|min:1',
            'authors.*' => 'required|numeric',
        ], function ($validator, $book, $authors) {
            return redirect()->route('book.edit')
                ->withErrors($validator)
                ->with('book', $book)
                ->with('authors', $authors);
        }, function ($request, $book) {
            $book->update([
                'title' => $request->get('title'),
                'year' => $request->get('year')
            ]);
            $book->authors()->detach();
            array_map(function ($author) use ($book) {
                $book->authors()->attach($author);
            }, $request->get('authors'));

            return redirect()->route('book.index')
                ->with('success', 'Book updated successfully.');
        }, [$book, $authors]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();
        return redirect()->route('book.index')
            ->with('success', 'Book deleted successfully.');
    }
}
