<?php

namespace App\Http\Controllers;
use App\Http\Controllers\foto;
use App\Http\Controllers\Password;



use App\Models\User;
use App\Models\Monitor;
use App\Models\Monitoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use \stdClass;
use App\Mail\WelcomeMail;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\message;

use App\changePassword;


class UserController extends Controller
{
    //create
    //read

    public function showAll()
    {
        $product = User::all();

        return $product;
    }

    public function showId($id)
    {
        $user = User::find($id);
        $monitor = Monitor::where('id', $user->id)->get();

        return response()
            ->json(['usuario' => $user, 'monitor' => $monitor]);
    }

    public function showToken($token)
    {
        $user = User::where('remember_token', $token)->first();

        $monitor = Monitor::where('id', $user->id)->first();

        if ($monitor) {
            return response()
                ->json($monitor);
        }
        return response()
            ->json($user);
    }

    public function findName($name)
    {

        $user = User::where('name', 'LIKE', '%' . $name)->get();

        return response()
            ->json($user);
    }

    //update

    public function changePassword(Request $request)
    {
        $user = User::findOrFail($request->id);



        // if ($user->password == $request->password) {
        if (Hash::check($request->password, $user->password)) {
            $user->password = Hash::make($request->newPassword);
            $user->save();
            return response()
                ->json(['data' => $user,]);
        }

        return response()
            ->json(['La contraseña actual no es la correcta'], 401);
    }

    public function updateData(Request $request)
    {
        $user = User::findOrFail($request->id);

        $monitor = Monitor::where('id', $request->id)->first();


        if ($user->email != $request->email || $monitor->email != $request->email) {
            $validator = validator::make($request->all(), [
                'email' => 'required|unique:users',
            ]);
            if ($validator->fails()) {
                return response()->json("Ya existe un usuario con el correo ingresado", 401);
            }
        }

        if ($monitor) {
            $monitor->name = $request->name;
            $monitor->lastName = $request->lastName;
            $monitor->email = $request->email;
            $monitor->description = $request->description;
            $monitor->phone_number = $request->phone_number;
            $monitor->save();

            return response()
                ->json(['data' => $monitor,]);

        }

        $user->name = $request->name;
        $user->lastName = $request->lastName;
        $user->email = $request->email;
        $user->save();

        return response()
            ->json(['data' => $user,]);
    }

    //delete

    public function deleteUser($id)
    {

        $user = User::findOrFail($id);
        $user->delete();

        $monitor = Monitor::where('id', $user->id)->first();

        if ($monitor) {
            $monitor->delete();

        }

        return response()
            ->json(['status' => 'eliminado',]);
    }

    public function saveImg(Request $request)
    {
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');

            $nombreArchivo = $request->id.'.'.$foto->getClientOriginalExtension();

            // Guardar la foto en almacenamiento local
            $ruta = $foto->storeAs('profile_photo', $nombreArchivo,'public_html');

            $monitor = Monitor::where('id', $request->id)->first();
            $monitor->url_img_profile = $nombreArchivo;
            $monitor->save();

            return response()
            ->json("Foto guardada exitosamente");
        }

        return response()
        ->json( "No se ha proporcionado ninguna foto",404);
    }

    public function sendResetLinkEmail($email)
    {

        $user = User::where('email',$email)->first();

        $pin = rand(100000, 999999);

        Mail::to($email)->send(new changePassword($user->name , $pin));

        $user->pin = $pin;
        $user->save();
    }

    public function resetPassword($pin)
    {
        $user = User::where('pin',$pin)->first();

        echo($user->name);

        // if ($user->pin == $request->pin) {
        //     return response()
        //     ->json( "Pin valido");
        // }

        return response()
        ->json( "Pin incorrecto",404);
    }


}
