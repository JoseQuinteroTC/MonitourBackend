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

        $validator = validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'description' => 'required|string|max:255',
            'phone_number' => 'required|max:20',
            'document' => 'required|max:20',
            'url_img_profile' => 'required|string|max:255',


        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }

        $monitor = Monitor::create([
            'name' => $request->name,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'description' => $request->description,
            'phone_number' => $request->phone_number,
            'document' => $request->document,
            'url_img_profile' => $request->url_img_profile,
        ]);


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
}
