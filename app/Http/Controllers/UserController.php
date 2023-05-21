<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Monitor;
use App\Models\Monitoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use \stdClass;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\message;


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
<<<<<<< HEAD

=======
>>>>>>> 3d0a3b83b6f37776aa7046048cb669a42ece5c44
        }

        return response()
            ->json(['status' => 'eliminado',]);
    }

    public function email(Request $request)
    {
        // Código para registrar al usuario
        // ...

        // Enviar correo de bienvenida utilizando una plantilla HTML
        $user = User::find($request->id);
        $data = array('name' => "hola");
        Mail::send('emails.welcome', $data, function ($message) use ($user) {
            $message->to("monitour04@gmail.com", "hola")
                ->subject('Bienvenido a mi sitio web');
        });

        return  response()
            ->json(['status' => 'eliminado',]);
    }
<<<<<<< HEAD
=======

    public function uploadImg(Request $request)
    {

        if($request->hasfile('image'))
        {
            $file=$request->file('image');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('public/img_profile',$filename);
            return $request;
        }
        else
        {
            return $request;
        }

        return response()->json(['response'=>['code'=>'200','message'=>'image uploaded successfull']]);
    }
>>>>>>> 3d0a3b83b6f37776aa7046048cb669a42ece5c44
}
