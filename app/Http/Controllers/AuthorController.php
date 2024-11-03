<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $authors = Author::latest()->paginate(10);
        return view('author.index', compact('authors'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('author.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        return $this->validate($request, [
            'name' => 'required|string|max:255',
            'birthday' => 'required|date_format:d/m/Y',
        ], function ($validator) {
            return redirect()->route('author.create')
                ->withErrors($validator);
        }, function ($request) {
            $author = Author::create([
                'name' => $request->get('name'),
                'birthday' => $request->get('birthday')
            ]);

            return redirect()->route('author.index')
                ->with('success', 'Author created successfully.')
                ->with('author', $author);
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author): View
    {
        return view('author.show', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author): View
    {
        return view('author.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author): RedirectResponse
    {
        return $this->validate($request, [
            'name' => 'required|string|max:255',
            'birthday' => 'required|date_format:d/m/Y',
        ], function ($validator, $author) {
            return redirect()->route('author.edit')
                ->withErrors($validator)
                ->with('author', $author);
        }, function ($request, $author) {
            $author->update([
                'name' => $request->get('name'),
                'birthday' => $request->get('birthday')
            ]);

            return redirect()->route('author.index')
                ->with('success', 'Author updated successfully.');
        }, [$author]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author): RedirectResponse
    {
        $author->delete();
        return redirect()->route('author.index')
            ->with('success', 'Author deleted successfully.');
    }
}
