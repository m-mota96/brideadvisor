<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Provider;
use App\City;
use App\CategoryProvider;
use App\Location;
use App\GalleryProvider;
use App\RatingProvider;
use App\Customer;
use Carbon\Carbon;
use App\StatisticProvider;
use App\Payment;
use App\Key;
use App\GalleryPromotion;
use App\Promotion;
use App\AttentionSchedule;
use DateTime;

class ShowCaseController extends Controller
{
    public function __construct() {
        date_default_timezone_set('America/Mexico_City');
        setlocale(LC_ALL, 'es_MX');
    }

    public function index() {
        $company = Provider::with('user')->with('location')->whereHas('user', function($query) {
            return $query->where('id', Auth::user()->id);
        })->first();
        foreach ($company->location as $key => $value) {
            $city = City::where('id', $value->city_id)->first();
            $value->city = $city->city;
        }
        $categories = CategoryProvider::all();
        return view('provider.escaparate')->with(['company' => $company, 'categories' =>$categories]);
    }

    public function checkPassword(Request $request) {
        $validate = User::where('id', $request->input('idUser'))->first();
        if (Hash::check($request->input('password'), $validate->password)) {
            return response()->json([
                'status' => 'match'
            ]);
        } else {
            return response()->json([
                'status' => 'no_match'
            ]);
        }
    }

    public function updateCredentials(Request $request) {
        $user = User::where('id', Auth::user()->id)->first();
        if(!empty($request->input('password'))) {
            $user->email = $request->input('user');
            $user->password = bcrypt($request->input('password'));
        } else {
            $user->email = $request->input('user');
        }
        if($user->save()) {
            return response()->json([
                'status' => 'saved'
            ]);
        } else {
            return response()->json([
                'status' => 'error'
            ]);
        }
    }

    public function extractLocation(Request $request) {
        $location = Location::where('id', $request->input('location_id'))->first();
        return response()->json([
            'location' => $location
        ]);
    }

    public function updateContact(Request $request) {
        $location = Location::where('id', $request->input('location_id'))->first();
        $location->name_contact = $request->input('name_contact');
        $location->email_contact = $request->input('email_contact');
        $location->phone = $request->input('phone');
        $location->cellphone = $request->input('cellphone');
        $location->website = $request->input('website');
        if($location->save()) {
            return response()->json([
                'status' => 'saved'
            ]);
        } else {
            return response()->json([
                'status' => 'error'
            ]);
        }
    }

    public function updateInfo(Request $request) {
        $provider = Provider::with('user')->where('user_id', Auth::user()->id)->first();
        $user = User::where('id', Auth::user()->id)->first();
        if (file_exists('media/providers/'.$user->name)) {
            rename("media/providers/".$user->name, "media/providers/".$request->input('name_company'));
        }
        if (file_exists('media/videos/providers/'.$user->name)) {
            rename("media/videos/providers/".$user->name, "media/videos/providers/".$request->input('name_company'));
        }
        $provider->description = $request->input('description_company');
        $provider->category_id = $request->input('category');
        $user->name = $request->input('name_company');
        if($provider->save() && $user->save()) {
            return response()->json([
                'status' => 'saved'
            ]);
        } else {
            return response()->json([
                'status' => 'error'
            ]);
        }
    }

    public function updatePrices(Request $request) {
        $provider = Provider::where('id', $request->input('provider_id'))->first();
        $provider->price_min = $request->input('price_min');
        $provider->price_max = $request->input('price_max');
        if($provider->save()) {
            return response()->json([
                'status' => 'saved'
            ]);
        } else {
            return response()->json([
                'status' => 'error'
            ]);
        }
    }

    public function location() {
        $company = Provider::with('user')->with('location')->whereHas('user', function($query) {
            return $query->where('id', Auth::user()->id);
        })->first();
        foreach ($company->location as $key => $value) {
            $city = City::where('id', $value->city_id)->first();
            $value->city = $city->city;
        }
        return view('provider.localizacion')->with(['company' => $company]);
    }

    public function updateAddress(Request $request) {
        $location = Location::where('id', $request->input('location_id'))->first();
        $location->address = $request->input('address');
        $location->postal_code = $request->input('postal_code');
        if(!empty($request->input('latitude')) && !empty($request->input('longitude'))) {
            $location->latitude = $request->input('latitude');
            $location->longitude = $request->input('longitude');
        }
        if($location->save()) {
            return response()->json([
                'status' => 'saved'
            ]);
        } else {
            return response()->json([
                'status' => 'error'
            ]);
        }
    }

    public function photos() {
        $provider = Provider::where('user_id', Auth::user()->id)->first();
        $gallery = GalleryProvider::where('provider_id', $provider->id)->where('type', 'img')->get();
        $video = GalleryProvider::where('provider_id', $provider->id)->where('type', 'video')->first();
        return view('provider.fotos')->with(['gallery' => $gallery, 'video' => $video]);
    }

    public function uploadImages(Request $request) {
        if (!file_exists('media/providers/'.Auth::user()->name)) {
            mkdir('media/providers/'.Auth::user()->name, 0777, true);
        }
        $provider = Provider::where('user_id', Auth::user()->id)->first();
        for ($i=0; $i < sizeof($_FILES['files']['name']); $i++) { 
            $file = file_get_contents($_FILES['files']['tmp_name'][$i]);
            $extension = pathinfo($_FILES["files"]["name"][$i])["extension"];
            $fileName = uniqid().".".$extension;
            file_put_contents('media/providers/'.Auth::user()->name.'/'.$fileName, $file);
            $image = GalleryProvider::create([
                'provider_id' => $provider->id,
                'name_image' => $fileName,
                'type' => 'img'
            ]);
        }
        return response()->json([
            'status' => 'saved',
            'data' => $image,
            'name' => Auth::user()->name
        ]);
    }

    public function checkVideo(Request $request) {
        $provider = Provider::where('user_id', Auth::user()->id)->first();
        $count = GalleryProvider::where('type', 'video')->where('provider_id', $provider->id)->get()->count();
        if($count==0) {
            return response()->json([
                'status' => 'ok'
            ]);
        } else {
            return response()->json([
                'status' => 'denied'
            ]);
        }
    }

    public function uploadVideo(Request $request) {
        if (!file_exists('media/videos/providers/'.Auth::user()->name)) {
            mkdir('media/videos/providers/'.Auth::user()->name, 0777, true);
        }
        $file = file_get_contents($_FILES['archivo']['tmp_name']);
        $extension = pathinfo($_FILES["archivo"]["name"])["extension"];
        $fileName = uniqid().".".$extension;
        file_put_contents('media/videos/providers/'.Auth::user()->name.'/'.$fileName, $file);
        $provider = Provider::where('user_id', Auth::user()->id)->first();
        $video = GalleryProvider::create([
            'provider_id' => $provider->id,
                'name_image' => $fileName,
                'type' => 'video'
        ]);
        return response()->json([
            'status' => 'saved',
            'video' => $video->name_image,
            'name' => Auth::user()->name
        ]);
    }

    public function deleteGalleryProvider(Request $request) {
        $image = GalleryProvider::with('provider.user')->where('id', $request->input('id'))->first();
        if($request->input('type')=='image') {
            if(file_exists('media/providers/'.$image->provider->user->name.'/'.$image->name_image)) {
                unlink('media/providers/'.$image->provider->user->name.'/'.$image->name_image);
            }
        } elseif($request->input('type')=='video') {
            unlink('media/videos/providers/'.$image->provider->user->name.'/'.$image->name_image);
        }
        $image->delete();
        return response()->json([
            'status' => 'deleted'
        ]);
    }

    public function profileOrLogotype(Request $request) {
        $provider = Provider::where('user_id', Auth::user()->id)->first();
        $update = GalleryProvider::where('id', $request->input('id'))->first();
        if($request->input('type')=='profile') {
            DB::table('gallery_providers')
            ->where('provider_id', $provider->id)
            ->update(['profile' => 0]);
            $update->profile = 1;
        } elseif($request->input('type')=='logotype') {
            DB::table('gallery_providers')
            ->where('provider_id', $provider->id)
            ->update(['logo' => 0]);
            $update->logo = 1;
        }
        if($update->save()) {
            return response()->json([
                'status' => 'saved'
            ]);
        }
    }

    public function recomendations() {
        $provider = Provider::where('user_id', Auth::user()->id)->first();
        $data = RatingProvider::with('customer.user')
        ->where('provider_id', $provider->id)->get();
        foreach ($data as $key => $value) {
            $mesStart = new Datetime($value->created_at);
            $mesStart = strftime("%B", $mesStart->getTimestamp());
            $dayStart = new Datetime($value->created_at);
            $value->date_parse = strftime("%d", $dayStart->getTimestamp()).' de '.ucfirst($mesStart).' de '.strftime("%Y", $dayStart->getTimestamp());
        }
        return view('provider.opiniones')->with(['opinions' => $data]);
    }

    public function stats() {
        $provider = Provider::with('statistic', 'user')
        ->where('user_id', Auth::user()->id)->first();
        return view('provider.estadisticas');
    }

    public function extractStatistic() {
        $provider = Provider::where('user_id', Auth::user()->id)->first();
        $date = Carbon::now();
        $dateTwo = Carbon::now();
        $startDate = $date->subDays(6)->format('d/F/Y');
        $initialDate = $dateTwo->subDays(6)->format('Y-m-d');
        $dates = array();
        $visits = $this->extractData('visit', $initialDate, $provider);
        $requests = $this->extractData('request', $initialDate, $provider);
        $searches = $this->extractData('search', $initialDate, $provider);
        for ($i=0; $i < 7 ; $i++) { 
            $dates[$i] = $startDate;
            $startDate = $date->addDay()->format('d/F/Y');
        }
        $arrayVisits = $this->parseArray($initialDate, $visits, $dateTwo);
        $arrayRequests = $this->parseArray($initialDate, $requests, $dateTwo);
        $arraySearches = $this->parseArray($initialDate, $searches, $dateTwo);
        return response()->json([
            'days' => $dates,
            'visits' => $arrayVisits,
            'requests' => $arrayRequests,
            'searches' => $arraySearches
        ]);
    }

    public function extractData($type, $initialDate, $provider) {
        $array = StatisticProvider::where('provider_id', $provider->id)
        ->where('type', $type)
        ->where('created_at', '>=', $initialDate)
        ->select('quantity', 'created_at')
        ->get()->toArray();
        return $array;
    }

    public function parseArray($initialDate, $array, $dateTwo) {
        $pos = 0;
        $arrayParse = array();
        for ($i=0; $i < 7; $i++) {
            if(sizeof($array)>0) {
                if($initialDate==$array[$pos]['created_at']) {
                    $arrayParse[$i] = $array[$pos]['quantity'];
                    if($pos<(sizeof($array)-1)) {
                        $pos++;
                    }
                } else {
                    $arrayParse[$i] = 0;
                }
                $initialDate = $dateTwo->addDay()->format('Y-m-d');
            } else {
                $arrayParse[$i] = 0;
            }
        }
        return $arrayParse;
    }

    public function account() {
        return view('provider.cuenta');
    }

    public function payments() {
        $provider = Provider::where('user_id', Auth::user()->id)->first();
        $payments = Payment::where('provider_id', $provider->id)->get();
        $keys = Key::where('name', $payments[0]->reference)->first();
        $totalPayments = 0;
        foreach ($payments as $key => $value) {
            $totalPayments = $totalPayments + $value->amount;
            $date = Carbon::parse(substr($value->created_at, 0, 10));
            $value->date_parse = $date->format('d-m-Y');
        }
        // dd($totalPayments);
        return view('provider.pagos')->with(['payments' => $payments, 'total_payed' => $totalPayments, 'key' => $keys]);
    }

    public function promotions() {
        $categories = CategoryProvider::orderBy('name')->get();
        $provider = Provider::where('user_id', Auth::user()->id)->first();
        $schedules = AttentionSchedule::where('provider_id', $provider->id)->first();
        $pos = 0;
        $string = '';
        $week = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        if(!empty($schedules)) {
            for($i=0; $i < strlen($schedules->days); $i++) {
                if(substr($schedules->days, $i, 1) != ',') {
                    $string = $string.(substr($schedules->days, $i, 1));
                } else {
                    $array[$pos] = $string;
                    $string = '';
                    $pos++;
                }
            }
            $ban = false;
            for ($i=0; $i < 7; $i++) { 
                for ($j=0; $j < sizeof($array); $j++) { 
                    if($week[$i]==$array[$j]) {
                        $ban = true;
                    }
                }
                if($ban==false) {
                    $week[$i] = '';
                }
                $ban = false;
            }
        } else {
            for ($i=0; $i < 7; $i++) { 
                $week[$i] = '';
            }
        }
        return view('provider.promociones')->with(['categories' => $categories, 'schedules' => $schedules, 'days' => $week]);
    }

    public function createPromotion(Request $request) {
        $addresses = '';
        $addresses = str_replace('/,', '/', $request->input('addresses'));
        $provider = Provider::where('user_id', Auth::user()->id)->first();
        $insertPromotion = Promotion::create([
            'provider_id' => $provider->id,
            'category_provider_id' => $request->input('category_id'),
            'price_initial' => $request->input('price_initial'),
            'price_final' => $request->input('price_final'),
            'expiration' => $request->input('date'),
            'description' => $request->input('description'),
            'name' => $request->input('name'),
            'addresses' => $addresses,
        ]);
        mkdir('media/promotions/'.$insertPromotion->id, 0777, true);
        for ($i=0; $i < sizeof($_FILES['files']['name']); $i++) { 
            $file = file_get_contents($_FILES['files']['tmp_name'][$i]);
            $extension = pathinfo($_FILES["files"]["name"][$i])["extension"];
            $fileName = uniqid().".".$extension;
            file_put_contents('media/promotions/'.$insertPromotion->id.'/'.$fileName, $file);
            $image = GalleryPromotion::create([
                'promotion_id' => $insertPromotion->id,
                'name' => $fileName,
            ]);
        }
        return response()->json([
            'status' => 'success'
        ]);
    }
}
