<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Event;

class BrideWeekendController extends Controller
{
    public function __construct() {
        date_default_timezone_set('America/Mexico_City');
    }

    public function index() {
        $data = $this->extractEvents(null);
        return view('brideweekend.index')->with(['data' => $data]);
    }

    public function exhibitor() {
        return view('brideweekend.expositor');
    }

    public function concept() {
        $data = $this->extractEvents(null);
        return view('brideweekend.concepto')->with(['cities' => $data]);
    }

    public function cities() {
        $data = $this->extractEvents(null);
        $years = Event::whereHas('event_type', function($query) {
            $query->where('type', 'brideweekend');
        })
        ->where('active', 1)
        ->select(DB::raw('Date_format(initial_date, "%Y") as year'))
        ->groupBy('year')
        ->orderBy('year', 'ASC')
        ->get();
        // foreach ($years as $key => $value) {
        //     if(empty($value->year)) {
        //         $value->year = 2021;
        //     }
        // }
        return view('brideweekend.ciudades')->with(['cities' => $data, "years" => $years]);
    }

    public function extractEvents($param) {
        if($param==null) {
            $data = Event::whereHas('event_type', function($query) {
                $query->where('type', 'brideweekend');
            })
            ->with('enclosure')
            // ->with('city')
            ->where('active', 1)
            ->orderBy('initial_date')
            ->with(['city' => function ($query) {
                $query->orderBy('city', 'ASC');
            }])
            ->get();
        } else {
            $data = $param;
        }
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        foreach ($data as $key => $value) {
            $fechaIni = Carbon::parse($value->initial_date);
            $fechaFin = Carbon::parse($value->final_date);
            $mes = $meses[($fechaIni->format('n')) - 1];
            $mestwo = $meses[($fechaFin->format('n')) - 1];
            $value->year = $fechaIni->format('Y');
            if($mes==$mestwo) {
                $value->dateParse = $mes.' '.$fechaIni->format('d').' y '. $fechaFin->format('d');
            } elseif(!empty($value->initial_date) && !empty($value->final_date)) {
                $value->dateParse = $mes.' '.$fechaIni->format('d').' y '. $mestwo .' '. $fechaFin->format('d');
            } else {
                $value->dateParse = $mes.' '.$fechaIni->format('d');
            }
        }
        return $data;
    }

    public function city($id) {
        $event = Event::whereHas('event_type', function($query) {
            $query->where('type', 'brideweekend');
        })
        ->with('city')
        ->with('enclosure')
        ->with('activitie')
        ->where('id', $id)
        ->get();
        if(sizeof($event)>0) {
            $data = $this->extractEvents($event);
            $entrySat = date("g:i a",strtotime(substr($data[0]->entry_sat,0,5)));
            $exitSat = date("g:i a",strtotime(substr($data[0]->entry_sat,-5,5)));
            $horarioSat = $entrySat.' - '.$exitSat;
            $entrySun = date("g:i a",strtotime(substr($data[0]->entry_sun,0,5)));
            $exitSun = date("g:i a",strtotime(substr($data[0]->entry_sun,-5,5)));
            $horarioSun = $entrySun.' - '.$exitSun;
            if($horarioSat==$horarioSun) {
                $data[0]->timeParse = 'Sábado y Domingo '.$horarioSat;
                $indicator = 0;
            } elseif(!empty($data[0]->entry_sat) && !empty($data[0]->entry_sun)) {
                $data[0]->timeParse = 'Sábado '.$entrySat.' - '.$exitSat.' <br>Domingo '.$entrySun.' - '.$exitSun;
                $indicator = 1;
            } else {
                $data[0]->timeParse = 'Domingo '.$entrySun.' - '.$exitSun;
                $indicator = 2;
            }
            return view('brideweekend.ciudad')->with(['data' => $data[0]]);
        } else {
            return redirect('/brideweekend');
        }
    }

    public function carrera() {
        return view('brideweekend.carrera');
    }

    public function gifts() {
        return view('brideweekend.regalos');
    }

    public function exhibitors($id) {
        $event = Event::with('provider.user', 'provider.location.city', 'provider.profile')->where('id', $id)->first();
        if(!empty($event)) {
            return view('brideweekend.expositores')->with(['event' => $event]);
        } else {
            return redirect('/brideweekend');
        }
    }
}
