<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Provider;
use App\CategoryProvider;
use App\User;
use App\Location;
use App\GalleryProvider;

class ExhibitorsController extends Controller
{
    public function exhibitors() {
        $events = Event::whereHas('event_type', function($query) {
            return $query->where('type', 'brideweekend');
        })->with('city')->orderBy('initial_date')->get();
        return view('admin.exhibitors')->with(['events' => $events]);
    }

    public function extractProviders() {
        $exhibitors = Provider::with('category', 'user')->with('event')->get();
        return datatables()->of($exhibitors)->toJson();
    }

    public function assignProviderToEvent(Request $request) {
        $event = Event::find($request->input('event_id'));
        $event->provider()->attach($request->input('provider_id'));
        return response()->json([
            'status' => 'assigned'
        ]);
    }

    public function staff() {
        $events = Event::whereHas('event_type', function($query) {
            return $query->where('type', 'brideweekend');
        })->with('city')->orderBy('initial_date')->get();
        return view('admin.staff')->with(['events' => $events]);
    }

    public function extractProvidersAssigned(Request $request) {
        $event_id= $request->input('event_id');
        $exhibitors = Provider::with('category')->with('user')->with('event')
        ->whereHas('event', function($query) use($event_id) {
            return $query->where('event_id', $event_id);
        })
        ->get();
        return datatables()->of($exhibitors)->toJson();
    }

    public function updateQuantityStaff(Request $request) {
        $event = Event::find($request->input('event_id'));
        $event->provider()->updateExistingPivot(
            $request->input('provider_id'), 
            [
                'quantity_staff' => $request->input('quantity') , 
                'staff_completed' => 1
            ]
        );
        return response()->json([
            'status' => 'updated'
        ]);
    }

    public function sendLinkStaff(Request $request) {
        $event = Event::find($request->input('event_id'));
        $event->provider()->updateExistingPivot(
            $request->input('provider_id'), 
            [
                'email' => $request->input('email')
            ]
        );
        return response()->json([
            'status' => 'updated'
        ]);
    }

    public function newprovider() {
        $categories = CategoryProvider::all();
        return view('admin.newprovider')->with(['categories' => $categories]);
    }

    public function createProvider(Request $request) {
        $user = User::where('email', $request->input('user'))->first();
        if(empty($user)) {
            $user = User::create([
                'role_id' => 2,
                'name' => $request->input('name'),
                'email' => $request->input('user'),
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password' => bcrypt($request->input('password')),
            ]);
            $provider = Provider::create([
                'user_id' => $user->id,
                'category_id' => $request->input('category'),
                'description' => $request->input('description')
            ]);
            Location::create([
                'provider_id' => $provider->id,
                'city_id' => $request->input('city'),
                'address' => $request->input('address'),
                'postal_code' => $request->input('postal_code'),
                'name_contact' => $request->input('contact'),
                'email_contact' => $request->input('email'),
                'phone' => $request->input('phone'),
                'cellphone' => $request->input('cellphone'),
                'active' => 1,
            ]);
            return response()->json([
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 'user_duplicate'
            ]);
        }
    }

    public function extractCategories() {
        $categories = CategoryProvider::orderBy('name')->get();
        return response()->json([
            'categories' => $categories
        ]);
    }

    public function updateStatusUser(Request $request) {
        $user = User::where('id', $request->input('user_id'))->first();
        $user->active = $request->input('status');
        $user->save();
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function updateCategory(Request $request) {
        $provider = Provider::where('id', $request->input('provider_id'))->first();
        $provider->category_id = $request->input('category_id');
        $provider->save();
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function extractCity(Request $request) {
        $location = Location::where('provider_id', $request->input('provider_id'))->where('city_id', $request->input('city_id'))->first();
        return response()->json([
            'location' => $location
        ]);
    }

    public function saveNewCity(Request $request) {
        $check = Location::where('provider_id', $request->input('provider_id'))->where('city_id', $request->input('city_id'))->first();
        if(!empty($check)) {
            $check->address = $request->input('address');
            $check->postal_code = $request->input('postal_code');
            $check->name_contact = $request->input('contact');
            $check->email_contact = $request->input('email');
            $check->phone = $request->input('phone');
            $check->cellphone = $request->input('cellphone');
            $check->website = $request->input('website');
            $check->save();
        } else {
            Location::create([
                'provider_id' => $request->input('provider_id'),
                'city_id' => $request->input('city_id'),
                'address' => $request->input('address'),
                'postal_code' => $request->input('postal_code'),
                'name_contact' => $request->input('contact'),
                'email_contact' => $request->input('email'),
                'phone' => $request->input('phone'),
                'cellphone' => $request->input('cellphone'),
                'website' => $request->input('website'),
                'active' => 1
            ]);
        }
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function gallery($id) {
        $gallery = GalleryProvider::with('provider.user')->where('provider_id', $id)->where('type', 'img')->where('profile', '!=', '1')->get();
        return view('admin.gallery')->with(['gallery' => $gallery]);
    }
}
