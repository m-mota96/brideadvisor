<?php

namespace App\Http\Controllers;

use App\Invitation;
use App\Table;
use App\Wedding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvitationController extends Controller
{
    public function index()
    {
        $wedding_id = Wedding::where('customer_id',Auth::user()->customer->id )->first()->id;
        $tables = Table::with('invitation')->whereHas('invitation', function($query) use($wedding_id){
            $query->where('wedding_id', $wedding_id);
        })->get();

        return view('customer.invitation', [
            'tables' => $tables,
            'invitationWithoutTable' => Invitation::where('wedding_id', $wedding_id)->whereNull('table_id') ->count(),
        ]);
    }
    public function createTable(Request $request)
    {
        $table = Table::create([
            'name' => $request->name,
            'quantity' =>  $request->quantity,
        ]);

        foreach ($request->guests as $guest){
            $guests = Invitation::find($guest);
            $guests->fill([
                'table_id' => $table->id
            ])->save();

        }
        return redirect()->back()->with('success', 'your message,here');

    }
    public function addGuest(Request $request)
    {
        $wedding_id = Wedding::where('customer_id',Auth::user()->customer->id )->first()->id;
        $validatedData = $request->validate([
            'firstname' => 'required|max:255',
            'lastname' => 'required',
            'cellphone' => 'required',
            'email' => 'email',
        ]);
      $guest =  Invitation::create($validatedData);
      $guest->fill([
          'wedding_id' => $wedding_id,
          'status' => 1
      ])->save();
        return redirect()->back()->with('success', 'your message,here');
    }
}
