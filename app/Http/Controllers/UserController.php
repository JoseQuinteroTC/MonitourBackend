<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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

        return response()
            ->json(['data' => $user,]);
    }

    public function showToken(Request $request)
    {
        $user = auth()->user();

        return response()
            ->json(['data' => $user,]);
    }

    public function findName($name)
    {

        $user = User::where('name', $name )->get();

        return response()
            ->json(['data' => $user,]);
    }

    //update

    public function changePassword(Request $request)
    {
        $user = User::findOrFail($request->id);

        $user->password = $request->password;
        $user->save();

        return response()
            ->json(['data' => $user,]);
    }

    public function updateData(Request $request)
    {
        $user = User::findOrFail($request->id);

        $user->name = $request->name;
        $user->lastName = $request->lastName;
        $user->password = $request->password;
        $user->save();

        return response()
            ->json(['data' => $user,]);
    }

    //delete

    public function deleteUser($id)
    {

        $user = User::findOrFail($id);
        $user->delete();

        return response()
            ->json(['status' => 'eliminado',]);
    }
}
