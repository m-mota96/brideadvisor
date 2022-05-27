<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\CategoryProvider;
use App\RatingProvider;
use App\Provider;
use App\Customer;
use App\StatisticProvider;
use App\Dictionary;
use DateTime;
use Carbon\Carbon;

class ProviderController extends Controller
{
    public function index() {
        if(empty($_GET)) {
            $providers = Provider::with('user', 'category', 'profile')
            ->whereHas('user', function($query) {
                return $query->where('active', 1);
            })
            ->whereHas('profile', function($query) {
                return $query->where('profile', 1);
            })
            ->inRandomOrder()
            ->limit(16)
            ->get();
            $providers = $this->createSlug($providers);
        } else {
            if($_GET['type']=='provider') {
                $name = str_replace(' ', '-', $_GET['search']);
                return redirect('proveedor/'.$name);
            } else {
                if($_GET['type']=='category') {
                    $category = CategoryProvider::where('name', $_GET['search'])->first();
                    $category_id = $category->id;
                } else {
                    $dictionary = Dictionary::where('word', $_GET['search'])->first();
                    $category_id = $dictionary->category_provider_id;
                }
                $city = $_GET['city'];
                $providers = Provider::with('user', 'category', 'profile')
                ->whereHas('user', function($query) {
                    return $query->where('active', 1);
                })
                ->whereHas('location', function($query) use($city) {
                    if(!empty($city)) {
                        return $query->where('city_id', $city);
                    }
                })
                ->where(function($query) use($category_id) {
                    if(!empty($category_id)) {
                        return $query->where('category_id', $category_id);
                    }
                })
                ->get();
            }
        }
        $categories = CategoryProvider::orderBy('name')->get();
        foreach ($categories as $key => $value) {
            $value->name = str_replace('/', '-', $value->name);
        }
        return view('providers.index')->with(['categories' => $categories, 'providers' => $providers]);
    }

    public function provider($slug) {
        $name = str_replace('-', ' ', $slug);
        $provider = Provider::with('user', 'gallery', 'location.city', 'category', 'rating.customer.user')
        ->whereHas('user', function($query) use($name) {
            return $query->where('name', $name);
        })->first();
        if(isset(Auth::user()->id)) {
            if (Auth::user()->role_id==3) {
                $stats = StatisticProvider::where('provider_id', $provider->id)
                ->where('type', 'visit')
                ->where('created_at', date('Y-m-d'))
                ->first();
                if(empty($stats)) {
                    StatisticProvider::create([
                        'provider_id' => $provider->id,
                        'type' => 'visit',
                        'quantity' => 1,
                        'created_at' => date('Y-m-d')
                    ]);
                } else {
                    $stats->quantity = $stats->quantity + 1;
                    $stats->save();
                }
            }
        }
        $price = 0;
        $quality = 0;
        $professionalism = 0;
        $attention = 0;
        $div = 0;
        $sum = 0;
        foreach ($provider->rating as $key => $value) {
            $mesStart = new Datetime($value->created_at);
            $mesStart = strftime("%B", $mesStart->getTimestamp());
            $dayStart = new Datetime($value->created_at);
            $value->date_parse = strftime("%d", $dayStart->getTimestamp()).' de '.ucfirst($mesStart).' de '.strftime("%Y", $dayStart->getTimestamp());
            $value->average = ($value->price+$value->quality+$value->professionalism+$value->attention) / 4;
            $price = $price + $value->price;
            $quality = $quality + $value->quality;
            $professionalism = $professionalism + $value->professionalism;
            $attention = $attention + $value->attention;
            $div++;
        }
        if(!empty($div) && $div!=0) {
            $price = $price / $div;
            $quality = $quality / $div;
            $professionalism = $professionalism / $div;
            $attention = $attention / $div;
            $sum = ($price + $quality + $professionalism + $attention) / 4;
            $sum = round($sum, 1);
        }
        return view('providers.provider')->with(['provider' => $provider, 'average' => $sum, 'opinions' => $div]);
    }

    public function filterForCategory(Request $request) {
        $providers = Provider::with('user', 'category', 'profile')
        ->whereHas('user', function($query) {
            return $query->where('active', 1);
        })
        ->whereHas('location', function($query) use($request) {
            if(!empty($request->input('city_id'))) {
                return $query->where('city_id', $request->input('city_id'));
            }
        })
        ->where(function($query) use($request) {
            if(!empty($request->input('category_id'))) {
                return $query->where('category_id', $request->input('category_id'));
            }
        })
        ->whereHas('user', function($query) {
            return $query->where('active', 1);
        })
        ->whereHas('profile', function($query) {
            return $query->where('profile', 1);
        })
        ->get();
        $providers = $this->createSlug($providers);
        return response()->json([
            'providers' => $providers
        ]);
    }

    public function createSlug($providers) {
        foreach ($providers as $key => $value) {
            $value->slug = str_replace(' ', '-', $value->user->name);
        }
        return $providers;
    }

    public function saveQualification(Request $request) {
        if(isset(Auth::user()->id)) {
            if(Auth::user()->role_id==3) {
                $customer = Customer::where('user_id', Auth::user()->id)->first();
                $check = RatingProvider::where('customer_id', $customer->id)->where('provider_id', $request->input('provider_id'))->first();
                if(empty($check)) {
                    if($request->input('type')=='comment') {
                        $value = [
                            'provider_id' => $request->input('provider_id'),
                            'customer_id' => $customer->id,
                            'message'=> $request->input('message'),
                        ];
                    } elseif($request->input('type')=='qualification') {
                        $value = [
                            'provider_id' => $request->input('provider_id'),
                            'customer_id' => $customer->id,
                            'price'=> $request->input('price'),
                            'quality'=> $request->input('quality'),
                            'professionalism'=> $request->input('professionalism'),
                            'attention'=> $request->input('attention'),
                        ];
                    }
                    $qualification = RatingProvider::create($value);
                    return response()->json([
                        'status' => 'success'
                    ]);
                } else {
                    if($request->input('type')=='comment') {
                        if($check->message==null) {
                            $check->message = $request->input('message');
                            $check->save();
                            return response()->json([
                                'status' => 'success'
                            ]);
                        } else {
                            return response()->json([
                                'status' => 'denied_access',
                                'msg' => 'Usted ya hizo comentarios sobre este proveedor'
                            ]);
                        }
                    } elseif($request->input('type')=='qualification') {
                        if($check->price==null && $check->quality==null && $check->professionalism==null && $check->attention==null) {
                            $check->price = $request->input('price');
                            $check->quality =$request->input('quality');
                            $check->professionalism = $request->input('professionalism');
                            $check->attention = $request->input('attention');
                            $check->save();
                            return response()->json([
                                'status' => 'success'
                            ]);
                        } else {
                            return response()->json([
                                'status' => 'denied_access',
                                'msg' => 'Usted ya calificó a este proveedor'
                            ]);
                        }
                    }
                }
            } else {
                return response()->json([
                    'status' => 'not_customer'
                ]);
            }
        } else {
            return response()->json([
                'status' => 'not_session'
            ]);
        }
    }

    public function autocompleteProviders(Request $request) {
        $providers = Provider::with('user')
        ->whereHas('user', function($query) use($request) {
            return $query->where('name', 'LIKE', '%'.$request->input('term').'%')->where('role_id', 2);
        })->get();
        $categories = CategoryProvider::where('name', 'LIKE', '%'.$request->input('term').'%')->get();
        $dictionaries = Dictionary::where('word', 'LIKE', '%'.$request->input('term').'%')->get();
        $data = array();
        $pos = 0;
        foreach ($providers as $key => $prov) {
            $data[$key]['value'] = $prov->user->name;
            $data[$key]['type'] = 'provider';
            $data[$key]['label'] = $prov->user->name;
            $pos = $key + 1;
        }
        foreach ($categories as $key => $cat) {
            $data[$pos]['value'] = $cat->name;
            $data[$pos]['type'] = 'category';
            $data[$pos]['label'] = $cat->name;
            $pos++;
        }
        foreach ($dictionaries as $key => $dic) {
            $data[$pos]['value'] = $dic->word;
            $data[$pos]['type'] = 'dictionary';
            $data[$pos]['label'] = $dic->word;
            $pos++;
        }
        return response()->json($data);
    }

    public function searchWord(Request $request) {
        if($request->input('type')=='provider') {
            $provider = Provider::with('user')
            ->whereHas('user', function($query) use($request) {
                return $query->where('name', $request->input('value'));
            })->first();
            $provider->slug = str_replace(' ', '-', $provider->user->name);
            return response()->json([
                'data' => $provider->slug
            ]);
        } else {
            if($request->input('type')=='category') {
                $category = CategoryProvider::where('name', $request->input('value'))->first();
                $category_id = $category->id;
            } else {
                $dictionary = Dictionary::where('word', $request->input('value'))->first();
                $category_id = $dictionary->category_provider_id;
            }
            $providers = Provider::with('user', 'category', 'profile')
            ->whereHas('user', function($query) {
                return $query->where('active', 1);
            })
            ->whereHas('location', function($query) use($request) {
                if(!empty($request->input('city_id'))) {
                    return $query->where('city_id', $request->input('city_id'));
                }
            })
            ->where(function($query) use($category_id) {
                if(!empty($category_id)) {
                    return $query->where('category_id', $category_id);
                }
            })
            ->get();
            return response()->json([
                'providers' => $providers
            ]);
        }
    }
}
