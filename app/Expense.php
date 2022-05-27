<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    public function customers()
    {
        return $this->belongsToMany('App\Customer')->withPivot('cost', 'payed');
    }


    function expenseStat($customerId)
    {
        $sumCost = DB::table('customer_expense')
                    ->where('customer_id',$customerId)
                    ->sum('cost');

        $sumPayed = DB::table('customer_expense')
                    ->where('customer_id',$customerId)
                    ->sum('payed');
        $countCost = DB::table('customer_expense')
            ->where('customer_id',$customerId)
            ->count('cost');

        $countPayed = DB::table('customer_expense')
            ->where('customer_id',$customerId)
            ->count('payed');

        $expenseStat = [
                'costo'=> $sumCost,
                'pagado'=> $sumPayed,
                'countPayed'=> $countPayed,
                'countCost'=> $countCost,
            ];

        return $expenseStat;
    }
}
