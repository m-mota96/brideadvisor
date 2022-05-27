<?php

namespace App\Http\Controllers;

use App\Budget;
use App\Customer;
use App\Task;
use App\Wedding;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;

class TaskController extends Controller
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

        $now = Carbon::now();
        $cusomerId = $request->user()->customer->id;
        $task = new Task;
        $task->name = $request->name;
        $task->comment = $request->comment;
        $task->type = 1;
        $task->save();

        $task->customers()->attach($cusomerId, ['date' => $request->date, 'completed_at' => $now]);

        return redirect('customer/checklist');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }

    public function checklist(Request $request)
    {
        $tasks = DB::table('tasks')
                    ->join('customer_task', 'customer_task.task_id', '=', 'tasks.id')
                    ->join('customers', 'customers.id', '=', 'customer_task.customer_id')
                    ->select('tasks.*', 'customer_task.date','customer_task.comment', 'customer_task.completed_at')
                    ->where('customers.id', $request->user()->customer->id)
                    ->get();

        $tasksPerPage = $tasks->groupBy(function($d) {
            return Carbon::parse($d->date)->format('Y-m-01');
        })->chunk(3);

        $id = $request->user()->customer->id;
        $wedding = Customer::find($id)->wedding;
        $diff = $wedding->diff($wedding->wedding_date);

        $percentageCompleted = round($tasks->where('completed_at', '!=', null)->count() / $tasks->count() * 100,2);
        return view('customer.checklist',[
            'tasksPerPage' => $tasksPerPage,
            'tasks' => $tasks,
            'diff' => $diff,
            'percentageCompleted' => $percentageCompleted
        ]);
    }

    public function saveBudget(Request $request)
    {
        $amount = $request->amount;
        $budget = Budget::updateOrCreate(
            ['customer_id' => $request->user()->customer->id],
            ['quantity' => $amount]
        );
        return $amount;
    }
    public function saveTask(Request $request)
    {
        $now = Carbon::now();
        $status = $request->status ? $now : null;
        $expenses = DB::table('customer_task')
            ->updateOrInsert(
                ['task_id' => $request->id, 'customer_id' => $request->user()->customer->id],
                ['date' => $request->date, 'completed_at' => $status, 'comment' => $request->comment]
            );
        return redirect('customer/checklist')->with('status', 'Profile updated!');
    }
}
