<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */





    public function index($firebase)
    {
        //Administrator = 2
        if($this->check($firebase)){
            $users =  User::with('repositories', 'role')->get();
            return response()->json($users);
        }else{
            return response()->json([]);
        }

    }

    public function userRepositories()
    {
        if($this->check($firebase)){
            $repositories = \App\Repository::with('photos', 'color', 'repository')
                ->orderBy('updated_at', 'desc')
                ->get();
            return response()->json($repositories);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $user  = \App\User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'api_token' => $request['firebase_uid']
        ]);
        return response($user, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, $firebase)
    {
        return response()->json(User::where('id', $user->id)->where('firebase_uid', $firebase)->first(), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        \App\User::where('id', $user->id)->first()->update(['firebase_uid' => $request->firebase_uid]);
        return response('Update Successfully', 200);

    }
    public function updateUser(Request $request, $user)
    {
        \App\User::where('id', (int)$user)->first()->update(['name' => $request->name, 'email'=>$request->email]);
        return response('Update Successfully', 200);

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, $firebase)
    {
        $userId = User::where('id', $user->id)->where('firebase_uid',  $firebase);
        if (!(empty($user->photo->file))) {
            unlink(public_path() . $user->photo->file);
        }
        $userId->delete();
    }

    /**
     * @param $firebase
     * @return bool
     */
    public function check($firebase)
    {
        return 2 === User::where('firebase_uid', $firebase)->first()->role_id;
    }
}
