<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function index()
    {
        $incomes = Income::where('user_id', Auth::id())->get();
        return inertia('Income',compact('incomes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response|\Inertia\ResponseFactory
     */
    public function create()
    {
        return inertia('CreateIncome');
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

        Income::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'entry_date' => now(),
            'description' => $request->description,
            'category' => $request->category,
        ]);

        return redirect()->route('income');
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
        $income = Income::where('user_id', Auth::id())->find($id);
        if($income == '')
        {
            abort(404);
        }
        return inertia('EditIncome', compact('income'));
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

        Income::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'entry_date' => now(),
            'description' => $request->description,
            'category' => $request->category,
        ])->where('id',$id);
        return redirect()->route('income');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Income::where('user_id', Auth::id())->find($id)->delete();
        return redirect()->route('income');
    }
}
