<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        if (request()->ajax()) {
        return new UserCollection(User::all());
        }
        return view('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
            $user = User::findOrFail($id);
        if (request()->ajax()) {
            return new UserResource($user);
        }
        return view('users.show',['user' => $user]);

    }
}
