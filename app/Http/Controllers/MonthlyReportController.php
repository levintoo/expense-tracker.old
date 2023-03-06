<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MonthlyReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function index()
    {
        $income_categories = Income::where('user_id', Auth::id())->select('category')->distinct()->get();
        $expenses_categories = Expense::where('user_id', Auth::id())->select('category')->distinct()->get();
        $income_categories_work = Income::where('user_id', Auth::id())->where('category','work')->select('amount')->get();
        $income_categories_business = Income::where('user_id', Auth::id())->where('category','business')->select('amount')->get();
        $income_categories_interest = Income::where('user_id', Auth::id())->where('category','interest')->select('amount')->get();
        $income_categories_family = Income::where('user_id', Auth::id())->where('category','family')->select('amount')->get();
        $expenses_categories_work = Expense::where('user_id', Auth::id())->where('category','work')->select('amount')->get();
        $expenses_categories_purchases = Expense::where('user_id', Auth::id())->where('category','purchases')->select('amount')->get();
        $expenses_categories_subscriptions = Expense::where('user_id', Auth::id())->where('category','subscriptions')->select('amount')->get();
        $expenses_categories_family = Expense::where('user_id', Auth::id())->where('category','family')->get();
        $expenses_categories_food = Expense::where('user_id', Auth::id())->where('category','food')->select('amount')->get();
        $expenses_categories_home = Expense::where('user_id', Auth::id())->where('category','home')->select('amount')->get();
        $income = Income::where('user_id', Auth::id())->select('amount')->get();
        $expenses = Expense::where('user_id', Auth::id())->select('amount')->get();
        $income_sum = $income->sum('amount');
        $expenses_sum = $expenses->sum('amount');
        $data = [
            'income' => $income_sum,
            'income_count' => $income->count(),
            'expenses' => $expenses_sum,
            'expenses_count' => $expenses->count(),
            'profit' => ($income_sum - $expenses_sum),
            'income_categories_count' => $income_categories->count(),
            'expenses_categories_count' => $expenses_categories->count(),
            'categories' => [
                'expenses' => [
                    'work' => [
                        'name' => 'work',
                        'amount' => $expenses_categories_work->sum('amount'),
                        'count' => $expenses_categories_work->count(),
                    ],
                    'purchases' => [
                        'name' => 'purchases',
                        'amount' => $expenses_categories_purchases->sum('amount'),
                        'count' => $expenses_categories_purchases->count(),
                    ],
                    'subscriptions' => [
                        'name' => 'subscriptions',
                        'amount' => $expenses_categories_subscriptions->sum('amount'),
                        'count' => $expenses_categories_subscriptions->count(),
                    ],
                    'family' => [
                        'name' => 'family',
                        'amount' => $expenses_categories_family->sum('amount'),
                        'count' => $expenses_categories_family->count(),
                    ],
                    'food' => [
                        'name' => 'food',
                        'amount' => $expenses_categories_food->sum('amount'),
                        'count' => $expenses_categories_food->count(),
                    ],
                    'home' => [
                        'name' => 'home',
                        'amount' => $expenses_categories_home->sum('amount'),
                        'count' => $expenses_categories_home->count(),
                    ],
                ],
                'income' => [
                    'work' => [
                        'name' => 'work',
                        'amount' => $income_categories_work->sum('amount'),
                        'count' => $income_categories_work->count(),
                    ],
                    'business' => [
                        'name' => 'business',
                        'amount' => $income_categories_business->sum('amount'),
                        'count' => $income_categories_business->count(),
                    ],
                    'interest' => [
                        'name' => 'interest',
                        'amount' => $income_categories_interest->sum('amount'),
                        'count' => $income_categories_interest->count(),
                    ],
                    'family' => [
                        'name' => 'family',
                        'amount' => $income_categories_family->sum('amount'),
                        'count' => $income_categories_family->count(),
                    ],
                ]
            ]
        ];
        return inertia('MonthlyReport', compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
