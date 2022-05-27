<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Wedding;

class Customer extends Model
{
    protected $fillable = [
        'user_id', 'boyfriend_name', 'girlfriend_name', 'wedding_id'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function category_providers()
    {
        return $this->belongsToMany('App\CategoryProvider', 'category_customer', 'customer_id', 'category_id');
    }
    public function wedding()
    {
        return $this->hasOne('App\Wedding');
    }
    public function tasks()
    {
        return $this->belongsToMany('App\Task')->withPivot('date', 'completed_at');
    }

    public function expenses()
    {
        return $this->belongsToMany('App\Expense')->withPivot('cost', 'payed');
    }

    public function rating_providers() {
        return $this->hasOne(RatingProvider::class);

    }
    function customerTask($tasks, $customer)
    {
        $taskPerMonth = $tasks->chunk($tasks->count() / Carbon::parse(Customer::find($customer->id)->wedding->wedding_date)->diffInMonths($customer->created_at));

        foreach ($taskPerMonth as $key => $tasks)
        {
            $date = $customer->created_at->addMonth($key);
            foreach ($tasks as $task){
                $customer->tasks()->attach($task->id, ['date' => $date]);
            }

        }
    }

    function customerExpense($expenses, $customer)
    {
        foreach ($expenses as $expense){
            $customer->expenses()->attach($expense->id);
        }

    }
}
