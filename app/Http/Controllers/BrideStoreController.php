<?php

namespace App\Http\Controllers;

require_once('bin/conekta-php-master/lib/Conekta.php');
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\BrideStorePayment;
use Endroid\QrCode\QrCode;
use App\Promotion;
use App\AttentionSchedule;
use App\Provider;
use Carbon\Carbon;
use App\Payment;
use App\Buyer;
use App\Event;
use App\CategoryProvider;
use DateTime;
use DateInterval;
use DatePeriod;

class BrideStoreController extends Controller
{
    private $ApiKey = 'key_sQdMeJqixL8cAGoDA8c7qw';
    private $ApiVersion = '2.0.0';

    public function index() {
        $promotions = Promotion::with('gallery', 'provider.user')->where('expiration',  '>=', DB::raw('curdate()'))->get();
        $categories = CategoryProvider::orderBy('name')->get();
        foreach ($promotions as $key => $value) {
            $value->price_initial = number_format($value->price_initial);
            $value->price_final = number_format($value->price_final);
        }
        return view('public.bridestore')->with(['promotions' => $promotions, 'categories' => $categories]);
    }

    public function promotion($id) {
        $initial_date = date('Y-m-d l');
        $promotion = Promotion::with('gallery', 'provider.user')->where('id', $id)->first();
        $schedules = AttentionSchedule::where('provider_id', $promotion->provider->id)->first();
        $ban = true;
        $string = '';
        $pos = 0;
        for ($i = 0; $i < strlen($promotion->addresses); $i++) {
            if (substr($promotion->addresses, $i, 1)!='/') {
                $string = $string.substr($promotion->addresses, $i, 1);
            } else {
                $addresses[$pos] = $string;
                $string = '';
                $pos++;
            }
        }
        $string = '';
        $pos = 0;
        for($i=0; $i < strlen($schedules->days); $i++) {
            if(substr($schedules->days, $i, 1) != ',') {
                $string = $string.(substr($schedules->days, $i, 1));
            } else {
                $attention_schedules[$pos] = $string;
                $string = '';
                $pos++;
            }
        }
        $final_date = $promotion->expiration;
        $dates = array();
        $days = array();
        $cont = 0;
        for($i = $initial_date; $i <= $final_date; $i = date("Y-m-d", strtotime($i ."+ 1 days"))) {
            if($cont==0) {
                $dates[$cont][0] = substr($i, 0, 10);
                $dates[$cont][1] = date('l');
            } else {
                $dates[$cont][0] = $i;
                $dates[$cont][1] = date("l", strtotime($i));
            }
            $cont++;
        }
        $ban = false;
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $days = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
        $count = sizeof($dates);
        for ($i=0; $i < $count; $i++) { 
            $fechaIni = Carbon::parse($dates[$i][0]);
            $mes = $meses[($fechaIni->format('n')) - 1];
            $day = $days[$fechaIni->format('w')];
            $dates[$i][2] = $day.' '.$fechaIni->format('d').' de '.$mes.' de '. $fechaIni->format('Y');
            for ($j=0; $j < sizeof($attention_schedules); $j++) { 
                if($dates[$i][1]==$attention_schedules[$j]) {
                    $ban = true;
                }
            }
            if($ban==false) {
                unset($dates[$i]);
                // unset($dates[$i][1]);
            }
            $ban = false;
        }
        $dates = array_values($dates);
        $promotion->price_initial = number_format($promotion->price_initial);
        $promotion->price_final = number_format($promotion->price_final);
        return view('public.promotion')->with(['promotion' => $promotion, 'dates' => $dates, 'providerId' => $promotion->provider->id, 'addresses' => $addresses]);
    }

    public function saveSchedules(Request $request) {
        $provider = Provider::where('user_id', Auth::user()->id)->first();
        $schedules = AttentionSchedule::where('provider_id', $provider->id)->first();
        if(empty($schedules)) {
            AttentionSchedule::create([
                'provider_id' => $provider->id,
                'days' => $request->input('days').',',
                'schedules' => $request->input('initial_time').'-'.$request->input('final_time'),
            ]);
        } else {
            $schedules->days = $request->input('days').',';
            $schedules->schedules = $request->input('initial_time').'-'.$request->input('final_time');
            $schedules->save();
        }
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function checkSchedules(Request $request) {
        $schedules = AttentionSchedule::where('provider_id', $request->input('provider_id'))->first();
        $initial_time = substr($schedules->schedules, 0, 5);
        $final_time = substr($schedules->schedules, 6, 5);
        $array_schedules = $this->intervalSchedules($initial_time, $final_time);
        $payments = Payment::where('event_id', 2)->where('provider_id', $request->input('provider_id'))->get();
        $array = array();
        $pos = 0;
        foreach ($payments as $key => $value) {
            $buyer = Buyer::where('payment_id', $value->id)->first();
            if($buyer->date_event==$request->input('date')) {
                $array[$pos] = substr($buyer->hour, 0, 5);
                $pos++;
            }
        }
        $ban = false;
        if(!empty($array)) {
            for ($i=0; $i < sizeof($array_schedules); $i++) { 
                for ($j=0; $j < sizeof($array); $j++) { 
                    if($array_schedules[$i]==$array[$j]) {
                        $ban = true;
                    }
                }
                if($ban==true) {
                    unset($array_schedules[$i]);
                }
                $ban = false;
            }
        }
        $array_schedules = array_values($array_schedules);

        return response()->json([
            'data' => $array_schedules
        ]);
    }

    public function makePayment(Request $request) {
        $promotion = Promotion::where('id', $request->input('promotion_id'))->first();
        try {
            $folio = strtoupper(uniqid());
            $qrCode = new QrCode($folio);//Creo una nueva instancia de la clase
            $qrCode->setWriterByName('png');
            $qrCode->setSize(250);//Establece el tamaño del qr
            $qrCode->setMargin(0);
            $image= $qrCode->writeString();//Salida en formato de texto
            $imageData = base64_encode($image);
            $dataqr = array(
                'img' => $imageData,
                'name' => $request->input('name'),
                'price' => '$1,000 MXN',
            );
            $pdf = \PDF::loadView('pdfstore', $dataqr)->save('media/pdf/citas/'.$folio.'.pdf');
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => 'Error en el sistema, su cargo no se efectuo. Comuníquese con soporte'
            ]);
        }

        \Conekta\Conekta::setApiKey($this->ApiKey);
        \Conekta\Conekta::setApiVersion($this->ApiVersion);
        $provider = Provider::with('user')->where('id', $request->input('provider_id'))->first();
        $description = 'Anticipo de cita con '.$provider->user->name;
        $event = Event::whereHas('event_type', function($query) {
            return $query->where('type', 'citas');
        })->first();
        if($this->createCustomer($request->input('name'), $request->input('email'), $request->input('conektaTokenId'))) {
            if($this->createOrder(1000, $description, 1)) {
                $payment = $this->registerPayment($event->id, substr($request->input('card'), -4), $request->input('email'), 'pagado', intval($request->input('provider_id')));
                Buyer::create([
                    'payment_id' => $payment->id,
                    'folio' => $folio,
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
                    'date_event' => $request->input('date'),
                    'hour' => $request->input('hour'),
                    'saturday_entry' => 0,
                    'sunday_entry' => 0,
                ]);
            } else {
                $this->deleteFiles($folios);
                return response()->json([
                    'status' => false,
                    'error' => $this->error
                ]);
            }
        } else {
            $this->deleteFiles($folios);
            return response()->json([
                'status' => false,
                'error' => $this->error
                // 'error' => $e->getMessage()
            ]);
        }
        $data = array(
            'price' => '1,000',
            'name' => $request->input('name'),
            'qr' => $imageData,
            'address' => $request->input('address'),
            'name_qr' => $folio
        );
        Mail::to($request->input('email'))->send(new BrideStorePayment($data));
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function registerPayment($event_id, $reference, $email, $status, $provider_id) {
        $payment = Payment::create([
            'event_id' => $event_id,
            'provider_id' => $provider_id,
            'reference' => $reference,
            'amount' => 1000,
            'email' => $email,
            'status' => $status,
        ]);
        return $payment;
    }

    public function filterPromotions(Request $request) {
        $promotions = Promotion::with('gallery', 'provider.user')->where('category_provider_id', $request->input('category_id'))->where('expiration',  '>=', DB::raw('curdate()'))->get();
        return response()->json([
            'promotions' => $promotions
        ]);
    }

    public function createCustomer($name, $email, $token) {
        try {
            $this->customer = \Conekta\Customer::create(
                array(
                    "name" => $name,
                    "email" => $email,
                    "payment_sources" => array(
                        array(
                            "type" => "card",
                            "token_id" => $token
                        )
                    )
                )
            );
        } catch (\Conekta\ProcessingError $error){
            $this->error = $error->getMessage();
            return false;
        } catch (\Conekta\ParameterValidationError $error){
            $this->error = $error->getMessage();
            return false;
        } catch (\Conekta\Handler $error){
            $this->error = $error->getMessage();
            return false;
        }
        return true;
    }

    public function createOrder($price, $description, $quantity) {
        try {
            $this->order = \Conekta\Order::create(
                array(
                    "amount"=>$price,
                    "line_items" => array(
                    array(
                        "name" => $description,
                        "unit_price" => $price*100, //se multiplica por 100 conekta
                        "quantity" => $quantity
                    )//first line_item
                    ), //line_items
                    "currency" => "MXN",
                    "customer_info" => array(
                    "customer_id" => $this->customer->id 
                    ), //customer_info
                    "charges" => array(
                        array(
                            "payment_method" => array(
                                    "type" => "default"
                            ) 
                        ) //first charge
                    ) //charges
                )//order
            );
        } catch (\Conekta\ProcessingError $error){
            $this->error = $error->getMessage();
            return false;
        } catch (\Conekta\ParameterValidationError $error){
            $this->error = $error->getMessage();
            return false;
        } catch (\Conekta\Handler $error){
            $this->error = $error->getMessage();
            return false;
        }
        return true;
    }

    function intervalSchedules($hora_inicio, $hora_fin, $intervalo = 60) {

        $hora_inicio = new DateTime( $hora_inicio );
        $hora_fin    = new DateTime( $hora_fin );
        $hora_fin->modify('+1 second'); // Añadimos 1 segundo para que nos muestre $hora_fin
    
        // Si la hora de inicio es superior a la hora fin
        // añadimos un día más a la hora fin
        if ($hora_inicio > $hora_fin) {
    
            $hora_fin->modify('+1 day');
        }
    
        // Establecemos el intervalo en minutos        
        $intervalo = new DateInterval('PT'.$intervalo.'M');
    
        // Sacamos los periodos entre las horas
        $periodo   = new DatePeriod($hora_inicio, $intervalo, $hora_fin);        
    
        foreach( $periodo as $hora ) {
    
            // Guardamos las horas intervalos 
            $horas[] =  $hora->format('H:i');
        }
    
        return $horas;
    }
}
