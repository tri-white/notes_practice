<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        if (request()->ajax()) {
        return new $users;
        }
        return view('users.index', ['users'=>$users]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
            $user = User::findOrFail($id);
        if (request()->ajax()) {
            return new $user;
        }
        return view('users.show',['user' => $user]);

    }
}
