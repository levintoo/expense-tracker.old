<?php

namespace App\Http\Controllers;

use App\Models\ExpensesCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpensesCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response|\Inertia\ResponseFactory
     */
    public function index()
    {
        request()->validate([
            'direction' => 'in:desc,asc',
            'field' => 'in:name,created',
        ]);

        $query = ExpensesCategory::query();

        $query->where('user_id', Auth::id());

        if(request('search'))
        {
            $query->where('name','LIKE','%'.request('search').'%');
        }

        if (request('field') == 'name')
        {
            $query->orderBy('name',request('direction'));
        }

        else if (request('field') == 'created')
        {
            $query->orderBy('created_at',request('direction'));
        }

        $categories = $query->paginate(5)->withQueryString();

        $filters = request()->all([
            'field',
            'search',
            'direction'
        ]);

        return inertia('ExpensesCategories', compact('categories', 'filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response|\Inertia\ResponseFactory
     */
    public function create()
    {
        return inertia('CreateExpenseCategory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExpensesCategory  $expenseCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ExpensesCategory $expenseCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExpensesCategory  $expenseCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ExpensesCategory $expenseCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExpensesCategory  $expenseCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExpensesCategory $expenseCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExpensesCategory  $expenseCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpensesCategory $expenseCategory)
    {
        //
    }
}
