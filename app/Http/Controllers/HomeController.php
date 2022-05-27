<?php

namespace App\Http\Controllers;
use App\Budget;
use App\CategoryProvider;
use App\Customer;
use App\Expense;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Provider;
use App\City;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $now = Carbon::now();
        $user = Auth::user();
        if ($user->role_id == 1) {
            return redirect()->route('admin.home');
        }
        if ($user->role_id == 2) {
            return redirect()->route('provider.home');
        }
        if ($user->role_id == 3) if ($user->created_at->diffInMinutes($now) > 2) {
            return redirect()->route('customer.home');
        }else {
            return redirect()->route('register.customer');
        }
    }

    public function adminHome()

    {
        return view('admin.index');
    }

    public function providerHome()
    {
        $company = Provider::with('user', 'location', 'category')->whereHas('user', function($query) {
            return $query->where('id', Auth::user()->id);
        })->first();
        foreach ($company->location as $key => $value) {
            $city = City::where('id', $value->city_id)->first();
            $value->city = $city->city;
        }
        $categories = CategoryProvider::all();
        return view('provider.index')->with(['company' => $company, 'categories' =>$categories]);
    }

    public function customerHome(Request $request)
    {
        $id = $request->user()->customer->id;
        $wedding = Customer::find($id)->wedding;

        $diff = $wedding->diff($wedding->wedding_date);
        $expense = new Expense();
        $expenseStat = $expense->expenseStat($id);

        $categories = CategoryProvider::all();
        $customerTasks = Customer::with('tasks')->where('id', $id)->first();

        $budget = Budget::where('customer_id', $id)->first();

        $date = new Carbon($wedding->wedding_date);

        return view('customer.index', [
            'customerTasks' => $customerTasks,
            'wedding'   => $wedding,
            'diff' => $diff ?? '',
            'date' => $date ?? '',
            'categories' => $categories,
            'expenseStat' => $expenseStat ?? ''
        ]);
    }

}
