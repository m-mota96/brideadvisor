<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provider;

class PublicController extends Controller
{
    public function index() {
        $providers = Provider::with('user', 'category', 'profile')
        ->whereHas('user', function($query) {
            return $query->where('active', 1)->where('role_id', 2);
        })
        ->whereHas('profile', function($query) {
            return $query->where('profile', 1);
        })
        ->whereHas('user', function($query) {
            return $query->where('active', 1);
        })
        ->whereHas('profile', function($query) {
            return $query->where('profile', 1);
        })
        ->inRandomOrder()
        ->limit(4)
        ->get();
        foreach ($providers as $key => $value) {
            $value->slug = str_replace(' ', '-', $value->user->name);
        }
        return view('public.index')->with(['providers' => $providers]);
    }
    public function brideMag()
    {
        return view('public.bride-mag');
    }
}
