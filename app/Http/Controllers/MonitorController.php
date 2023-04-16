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



    public function index()
    {
        //
        $product = Monitor::all();

        return $product;
    }

    public function addMonitorInfo(Request $request)
    {

        $validator = validator::make($request->all(), [
            'description' => 'required|string|max:255',
            'phoneNumber' => 'required|max:20',
            'url_img_profile' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }

        $monitor = Monitor::create([
            'description' => $request->description,
            'phoneNumber' => $request->phoneNumber,
            'url_img_profile' => $request->url_img_profile
        ]);


        return response()
            ->json(['data' => $monitor,]);
    }
}
