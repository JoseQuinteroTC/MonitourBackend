<?php

namespace App\Http\Controllers;

use App\Models\Monitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Imagen;
use stdClass;

class MonitorController extends Controller
{


    public function mostrarImagen($id)
    {
        $imagen = Monitor::find($id);
        if ($imagen) {
            return response($imagen->img_profile)
                ->header('Content-Type', 'image/jpg');
        } else {
            return response('Imagen no encontrada', 404);
        }
    }

    public function allMonitors()
    {
        $monitors = Monitor::all();
        $datos = array();

        foreach ($monitors as $monitors) {
            $objeto = new stdClass();
            $objeto->id = $monitors->id;
            $objeto->description = $monitors->description;
            $objeto->phoneNumber = $monitors->phoneNumber;
            $objeto->img_profile = response($monitors->img_profile)
            ->header('Content-Type', 'image/jpg'); // Convertir la imagen a base64
            $datos[] = $objeto;
        }

        return response()->json($datos);

    }

    public function allMonitors2()
    {
        $monitors = Monitor::all();
        $datos = array();

        foreach ($monitors as $monitors) {
            $objeto = new stdClass();
            $objeto->id = $monitors->id;
            $objeto->description = $monitors->description;
            $objeto->phoneNumber = $monitors->phoneNumber;
            $objeto->img_profile = asset('profile.jpg'); // Convertir la imagen a base64
            $datos[] = $objeto;
        }

        return response()->json($datos);
    }
}
