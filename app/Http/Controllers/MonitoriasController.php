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
        $product = Monitoria::all();

        return $product;
    }
    public function findName($title)
    {
        $monitoria = Monitoria::where('title', $title)->get();

        return response()
            ->json($monitoria);
    }

    public function addMonitoriaInfo(Request $request)
    {

        $validator = validator::make($request->all(), [
            'course' => 'required|string|max:255',
            'idMonitor' => 'required|max:20',
            'price' => 'required|max:20',
            'description' => 'required|string|max:255',
            'modality' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }

        $monitoria = Monitoria::create([
            'idMonitor' => $request->idMonitor,
            'course' => $request->course,
            'price' => $request->price,
            'description' => $request->description,
            'modality' => $request->modality,
            'views' => 0,
            'request' => 0,

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
            'description' => 'required|string|max:255',
            'modality' => 'required|string|max:255',
            ]);

        }

        $monitoria->name = $request->name;
        $monitoria->lastName = $request->lastName;
        $monitoria->email = $request->email;
        $monitoria->modality = $request->modality;
        $monitoria->save();

        return response()
            ->json(['data' => $monitoria,]);
    }

    public function qr($phone_number)
    {
        return response(QrCode::size(300)->generate('http://Wa.me/+57' . "" . $phone_number));
    }

    public function delete($id)
    {
        $monitoria = Monitoria::findOrFail($id);
        $monitoria->delete();

        return response()
            ->json(['status' => 'eliminado',]);
    }

    public function findMonitorias($idMonitor)
    {
        $monitoria = Monitoria::where('idMonitor', $idMonitor)->get();

        return response()
            ->json($monitoria);
    }
}
