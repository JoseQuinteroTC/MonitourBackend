<?php

namespace App\Http\Controllers;

use App\Models\Monitoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Imagen;
use Illuminate\Support\Facades\Validator;
use stdClass;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MonitoriasController extends Controller
{
    //
    public function findName($title)
    {
        $monitoria = Monitoria::where('title', $title)->get();

        return response()
            ->json($monitoria);
    }

    public function addMonitorInfo(Request $request)
    {

        $validator = validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'idMonitor' => 'required|max:20',
            'price' => 'required|max:20',
            'description' => 'required|string|max:255',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }

        $monitoria = Monitoria::create([
            'idMonitor' => $request->id,
            'title' => $request->title,
            'price' => $request->price,
            'description' => $request->description,

        ]);


        return response()
            ->json(['data' => $monitoria,]);
    }
}
