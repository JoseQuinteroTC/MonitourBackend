<?php

namespace App\Http\Controllers;

use App\Models\Monitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Imagen;
use Illuminate\Support\Facades\Validator;
use stdClass;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MonitorController extends Controller
{



    public function showAll()
    {
        //
        $product = Monitor::all();

        return $product;
    }

    public function addMonitorInfo(Request $request)
    {
        $user = User::findOrFail($request->id);

        $validator = validator::make($request->all(), [

            'description' => 'required|string',
            'phone_number' => 'required|max:20',
            'document' => 'required|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }

        $monitor = Monitor::create([
            'id' => $user->id,
            'name' => $user->name,
            'lastName' => $user->lastName,
            'email' => $user->email,
            'description' => $request->description,
            'phone_number' => $request->phone_number,
            'document' => $request->document,
            'url_img_profile' => '',
        ]);


        return response()
            ->json(['data' => $monitor,]);
    }

    public function updateData(Request $request)
    {
        $monitor = Monitor::findOrFail($request->id);

        if ($monitor->email != $request->email) {
            $validator = validator::make($request->all(), [
                'email' => 'required|unique:users',
            ]);
            if ($validator->fails()) {
                return response()->json("Ya existe un usuario con el correo ingresado", 401);
            }
        }


        $monitor->email = $request->email;
        $monitor->description = $request->description;
        $monitor->phone_number = $request->phone_number;
        $monitor->save();

        return response()
            ->json(['data' => $monitor,]);
    }

    public function changeImg(Request $request)
    {
        $monitor = Monitor::findOrFail($request->id);

        $monitor-> url_img_profile = $request->url_img_profile;
        $monitor->save();

        return response()
            ->json(['data' => $monitor,]);
    }

    public function deleteMonitor(Request $request)
    {
        $monitor = Monitor::findOrFail($request->id);
        $monitor->delete();

        return response()
            ->json(['status' => 'eliminado',]);
    }

    public function findName($name)
    {
        $monitor = Monitor::where('name', 'LIKE', '%' . $name )->get();

        return response()
            ->json($monitor);
    }
}
