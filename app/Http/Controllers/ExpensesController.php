<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
        request()->validate([
            'direction' => 'in:desc,asc',
            'field' => 'in:amount,description,category,entry_date',
        ]);

        $query = Expense::query();
        $query->where('user_id', Auth::id());

        if(request('search'))
        {
            $query->where(function ($query) {
                $query->where('Amount','LIKE','%'.request('search').'%')
                    ->orwhere('description','LIKE','%'.request('search').'%')
                    ->orwhere('category','LIKE','%'.request('search').'%');
            });
        }

        if (request('field'))
        {
            $query->orderBy(request('field'),request('direction'));
        }

        $expenses = $query->orderBy('entry_date','DESC')->paginate(5)->withQueryString();

        $filters = request()->all([
            'field',
            'search',
            'direction'
        ]);

        return inertia('Expenses', compact('expenses','filters'));
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
        $validated = Validator::make($request->all(), [
            'amount' => ['required','numeric'],
            'entry_date' => ['required'],
            'description' => ['required'],
            'category' => ['required'],
        ])->validate();

        Expense::create([
            'user_id' => Auth::id(),
            'amount' => $validated['amount'],
            'entry_date' => Carbon::make($validated['entry_date'])->toDateString(),
            'description' => $validated['description'],
            'category' => config('categories.income')[$validated['category']],
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
