<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    /**
     * return a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserResource::collection(User::OrderBy('updated_at', 'desc')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'active' => 'required | boolean',
            'admin' => 'required | boolean'
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'active' => $data['active'],
            'admin' => $data['admin']
        ]);

        return new UserResource($user);
    }

    /**
     * return the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if (Gate::denies('userAccess', $user)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'active' => 'required | boolean',
            'admin' => 'required | boolean',
            'password' => 'string|min:6',
        ]);

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->active = $data['active'];
        $user->admin = $data['admin'];
        if (array_key_exists('password', $data)) {
            $user->password = bcrypt(trim($data['password']));
        }

        if ($user->save()) {
            return response()->json($user);
        } else {
            return response()->json(['error' => 'Unprocessable'], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User  $user)
    {
        if ($user->delete()) {
            return response()->json(['message' => 'success'], 200);
        } else {
            return response()->json(['error' => 'Unprocessable'], 422);
        }
    }
}
