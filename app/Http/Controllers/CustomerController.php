<?php

namespace App\Http\Controllers;
use App\Expense;
use App\Task;
use App\Wedding;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }

    public function completeRegister(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'genre' => 'required',
            'invitados' => 'integer|min:5|max:300',
            'budget' => 'integer|min:10000',
            'wedding_date' => 'date|after:tomorrow'
        ]);

        $customer = Auth::user()->customer()->first();
        $tasks = Task::where('type',0)->get();

        $attribute = $request->genre == 'novia' ? 'girlfriend_name' : 'boyfriend_name';

        $wedding = $customer->wedding()->create([
            'wedding_date' => $request->wedding_date,
            'place' => $request->place,
            'engagement_date' => $request->engagement_date,
            'budget' => $request->budget,
        ]);


        $customer->fill([
            $attribute => $request->name,
        ])->save();

       // dd($customer);


        foreach ($request->category as $category) {
            $customer->category_providers()->attach($category);
        }
        if($wedding) {
            $customer->customerTask($tasks, $customer);
        }
            $expenses = Expense::where('type',0);
            $customer->customerExpense($expenses, $customer);
        return redirect()->route('customer.home');
    }
}
