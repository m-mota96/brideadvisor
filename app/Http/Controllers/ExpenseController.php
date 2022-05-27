<?php

namespace App\Http\Controllers;

use App\Budget;
use App\CategoryProvider;
use App\Customer;
use App\Expense;
use App\Task;
use App\Wedding;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $cusomerId = $request->user()->customer->id;
        $expense = new Expense();
        $expense->concept = $request->concept;
        $expense->type = 1;
        $expense->comment = $request->comment;
        $expense->save();
        $expense->customers()->attach($cusomerId, ['cost' => $request->cost, 'payed' => $request->payed]);

        return redirect('customer/expense');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        //
    }

    public function expense(Request $request)
    {
        $categoryProviders = CategoryProvider::all();
        $id = $request->user()->customer->id;
        $budget = Wedding::where('customer_id', $request->user()->customer->id)->first();
        $expenses = Customer::with(['expenses'])->where('id',$id)->first();

        $expense = new Expense();
        $expenseStat = $expense->expenseStat($id);

        $percentageCost = round( $expenseStat['costo'] / $budget->budget ?? '0' * 100);
        $percentagePayed = round( $expenseStat['pagado'] / $budget->budget ?? '0' * 100);


        return view('customer.expense',[
            'expenses' => $expenses->expenses,
            'categoryProviders' =>  $categoryProviders,
            'budget'    => $budget->budget ?? '',
            'expenseStat' => $expenseStat,
            'percentagePayed' => intval($percentagePayed),
            'percentageCost' => intval($percentageCost)
        ]);
    }

    public function saveExpense(Request $request)
    {
        $expenses =DB::table('customer_expense')
                    ->updateOrInsert(
            ['expense_id' => $request->id, 'customer_id' => $request->user()->customer->id],
            ['cost' => $request->cost, 'payed' => $request->payed, 'comment' => $request->comment]
        );
        return redirect('customer/expense')->with('status', 'Profile updated!');
    }
}
