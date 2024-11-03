<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $loans = Loan::latest()->paginate(10);
        return view('loan.index', compact('loans'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $users = User::all();
        $books = Book::all();
        return view('loan.create')
            ->with('users', $users)
            ->with('books', $books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $users = User::all();
        $books = Book::all();
        return $this->validate($request, [
            'book' => 'required|integer|exists:books,id',
            'user' => 'required|integer|exists:users,id',
        ], function ($validator, $users, $books) {
            return redirect()->route('loan.create')
                ->withErrors($validator)
                ->with('users', $users)
                ->with('books', $books);
        }, function ($request) {
            $loan = Loan::create([
                'book_id' => $request->get('book'),
                'user_id' => $request->get('user'),
                'loan_date' => now(),
                'return_date' => now()->addDays(30),
            ]);

            return redirect()->route('loan.index')
                ->with('success', 'Loan created successfully.')
                ->with('loan', $loan);
        }, [$users, $books]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Loan $loan): View
    {
        return view('loan.show', compact('loan'));
    }
}
