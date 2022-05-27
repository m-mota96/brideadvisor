<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EventType;
use App\Enclosure;
use App\Event;

class EventController extends Controller
{
    public function events() {
        $types = EventType::all();
        $enclosures = Enclosure::all();
        $events = Event::all();
        return view('admin.createEvents')->with(['type' => $types, 'enclosure' => $enclosures]);
    }

    public function extractEvents() {
        $events = Event::all();
        return datatables()->of($events)->toJson();
    }

    public function updateStatusEvent(Request $request) {
        $event = Event::where('id', $request->input('id'))->first();
        $event->active = $request->input('status');
        $event->save();
        return response()->json([
            'status' => 'saved'
        ]);
    }

    public function createEvent(Request $request) {
        $lastEvent = Event::select('id')->orderBy('id', 'DESC')->first();
        if($_FILES['imagePrincipal']['tmp_name'] && $_FILES['imagePdf']['tmp_name']) {
            if(empty($lastEvent)) {
                $id = 1;
            } else {
                $id = $lastEvent->id + 1;
            }
            if (!file_exists('media/events/'.$id)) {
                mkdir('media/events/'.$id, 0777, true);
            }
            $file = file_get_contents($_FILES['imagePrincipal']['tmp_name']);
            $extension = pathinfo($_FILES["imagePrincipal"]["name"])["extension"];
            $fileNamePrincipal = $id.'_'.$id.".".$extension;
            file_put_contents('media/events/'.$id.'/'.$fileNamePrincipal, $file);
            $file = file_get_contents($_FILES['imagePdf']['tmp_name']);
            $extension = pathinfo($_FILES["imagePdf"]["name"])["extension"];
            $fileNamePDF = uniqid().".".$extension;
            file_put_contents('media/events/'.$id.'/'.$fileNamePDF, $file);
            $file = file_get_contents($_FILES['imageEmail']['tmp_name']);
            $extension = pathinfo($_FILES["imageEmail"]["name"])["extension"];
            $fileNameEmail = uniqid().".".$extension;
            file_put_contents('media/events/'.$id.'/'.$fileNameEmail, $file);
            if(isset($_FILES['imageTickets']['tmp_name'])) {
                $file = file_get_contents($_FILES['imageTickets']['tmp_name']);
                $extension = pathinfo($_FILES["imageTickets"]["name"])["extension"];
                $fileNameTickets = $id.".".$extension;
                file_put_contents('media/events/'.$id.'/'.$fileNameTickets, $file);
            }
        } else {
            $fileNamePDF = null;
            $fileNameEmail = null;
        }

        Event::create([
            'city_id' => $request->input('selectCity'),
            'event_type_id' => $request->input('selectType'),
            'enclosure_id' => $request->input('selectEnclosure'),
            'name' => $request->input('nameEvent'),
            'organized_by' => $request->input('selectOrganized'),
            'active' => $request->input('radioActive'),
            'initial_date' => $request->input('initialDate'),
            'final_date' => $request->input('finalDate'),
            'entry_sat' => $request->input('entrySat').'-'.$request->input('exitSat'),
            'entry_sun' => $request->input('entrySun').'-'.$request->input('exitSun'),
            'ticket_price' => $request->input('priceTicket'),
            'img_pdf' => $fileNamePDF,
            'img_mail' => $fileNameEmail,
        ]);

        return redirect('admin/eventos');
    }

    public function enclosures() {
        return view('admin.enclosures');
    }

    public function extractEnclosures() {
        $enclosures = Enclosure::all();
        return datatables()->of($enclosures)->toJson();
    }

    public function createEnclosure(Request $request) {
        $file = file_get_contents($_FILES['imgEnclosure']['tmp_name']);
        $extension = pathinfo($_FILES["imgEnclosure"]["name"])["extension"];
        $fileNameEnclosure = uniqid().".".$extension;
        file_put_contents('media/enclosures/'.$fileNameEnclosure, $file);
        $file = file_get_contents($_FILES['imgLogo']['tmp_name']);
        $extension = pathinfo($_FILES["imgLogo"]["name"])["extension"];
        $fileNameLogo = uniqid().".".$extension;
        file_put_contents('media/enclosures/'.$fileNameLogo, $file);
        Enclosure::create([
            'name' => $request->input('nameEnclosure'),
            'address' => $request->input('address'), 
            'description' => $request->input('description'), 
            'map' => $request->input('map'), 
            'image' => $fileNameEnclosure, 
            'logo' => $fileNameLogo, 
        ]);
        return redirect('admin/recintos');
    }

    public function deleteEnclosure(Request $request) {
        $enclosure = Enclosure::where('id', $request->input('id'))->first();
        unlink('media/enclosures/'.$enclosure->image);
        unlink('media/enclosures/'.$enclosure->logo);
        if($enclosure->delete()) {
            return response()->json([
                'status' => 'deleted'
            ]);
        } else {
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
