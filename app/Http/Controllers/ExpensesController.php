<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function index()
    {
        $expenses = Expense::where('user_id', Auth::id())->get();

        return inertia('Expenses', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response|\Inertia\ResponseFactory
     */
    public function create()
    {
        $categories = config('categories.expenses');
        return inertia('CreateExpense', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'amount' => ['required'],
            'entry_date' => ['required'],
            'description' => ['required'],
            'category' => ['required'],
        ])->validate();

        Expense::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'entry_date' => now(),
            'description' => $request->description,
            'category' => config('categories.income')[$request->category],
        ]);

        return redirect()->route('expenses');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response|\Inertia\Response|\Inertia\ResponseFactory
     */
    public function show($id)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function edit($id)
    {
        $expense = Expense::where('user_id', Auth::id())->find($id);
        if($expense == '')
        {
            abort(404);
        }
        return inertia('EditExpense', compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'amount' => ['required'],
            'entry_date' => ['required'],
            'description' => ['required'],
            'category' => ['required'],
        ])->validate();

        Expense::where('user_id',Auth::id())->find($id)->update([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'entry_date' => now(),
            'description' => $request->description,
            'category' => $request->category,
        ]);
        return redirect()->route('expenses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Expense::where('user_id', Auth::id())->find($id)->delete();
        return redirect()->route('expenses');
    }
}
