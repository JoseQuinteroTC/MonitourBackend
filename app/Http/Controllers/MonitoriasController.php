<?php

namespace App\Http\Controllers;

use App\Models\Monitoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Imagen;
use Illuminate\Support\Facades\Validator;
use stdClass;
use App\Http\Controllers\str;
use App\Http\Controllers\mail;
use App\Http\Controllers\Arr;
use App\Models\Monitor;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;


class MonitoriasController extends Controller
{
    //

    public function showAll()
    {
        //

        $monitoria = Monitoria::all();


        return response()
            ->json($monitoria);
    }
    public function findName($title)
    {
        $monitoria = Monitoria::where('title', $title)->get();

        return response()
            ->json($monitoria);
    }

    public function addMonitoriaInfo(Request $request)
    {

        $monitor = Monitor::findOrFail($request->idMonitor);

        $validator = validator::make($request->all(), [
            'course' => 'required|string|max:255',
            'price' => 'required|max:20',
            'idMonitor' => 'required|max:20',
            'description' => 'required|string',
            'modality' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }

        $monitoria = Monitoria::create([
            'monitor' => $monitor->name . ' ' . $monitor->lastName,
            'idMonitor' => $request->idMonitor,
            'course' => $request->course,
            'price' => $request->price,
            'description' => $request->description,
            'modality' => $request->modality,
            'views' => 0,
            'request' => 0,
            'url_img_profile'  => $monitor->url_img_profile,

        ]);


        return response()
            ->json(['data' => $monitoria,]);
    }

    public function updateData(Request $request)
    {
        $monitoria = Monitoria::findOrFail($request->id);

        if ($monitoria->email != $request->email) {
            $validator = validator::make($request->all(), [
                'course' => 'required|string|max:255',
                'price' => 'required|max:20',
                'description' => 'required|string',
                'modality' => 'required|string',
            ]);
        }

        $monitoria->course = $request->course;
        $monitoria->price = $request->price;
        $monitoria->description = $request->description;
        $monitoria->modality = $request->modality;
        $monitoria->save();

        return response()
            ->json(['data' => $monitoria,]);
    }

    public function qr($id)//id de la monitoria
    {
        $monitoria = Monitoria::findOrFail($id);
        $monitor = Monitor::find($monitoria->idMonitor);

        $monitoria->request = $monitoria->request + 1;
        $monitoria->save();

        return response(QrCode::size(300)->generate('http://Wa.me/+57' . "" . $monitor->phone_number));
    }

    public function delete($id)
    {
        $monitoria = Monitoria::findOrFail($id);
        $monitoria->delete();

        return response()
            ->json(['status' => 'eliminado',]);
    }

    public function findMonitoria($id) //id de la monitoria
    {
        $monitoria = Monitoria::findOrFail($id);
        $monitor = Monitor::find($monitoria->idMonitor);

        $monitoria->views = $monitoria->views + 1;
        $monitoria->save();

        return response()
            ->json(['monitoria' => $monitoria, 'monitor' => $monitor,]);
    }

    public function findMonitoriaByMonitor($id) //id del monitor
    {
        $monitor = Monitor::find($id);
        $monitoria = Monitoria::where('idMonitor', $monitor->id)->get();

        return response()
            ->json($monitoria);
    }

    // public function findMonitoriaByCourse($course) //id de la monitoria
    // {
    //     $monitorias = Monitoria::where('course', 'LIKE', $course . '%')->get();

    //     $monitoriasRecomendadas = Arr::map($monitorias, $monitor = Monitor::find($monitorias->id));

    //     return response()
    //         ->json($monitoriasRecomendadas);
    // }

    public function findMonitoriasName($course)
    {
        $monitoria = Monitoria::where('course', 'LIKE', '%' . $course . '%')->get();

        return response()
            ->json($monitoria);
    }

    public function MonitoriasRelated($course)
    {
        $monitoria = Monitoria::where('course', 'LIKE', '%' . $course . '%')->take(6)->get();

        return response()
            ->json($monitoria);
    }


}
