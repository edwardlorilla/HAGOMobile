<?php

namespace App\Http\Controllers;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;
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
        if ($this->check($firebase)) {
            $users = User::with('repositories', 'role')->get();
            return response()->json($users);
        } else {
            return response()->json([]);
        }

    }

    public function userRepositories()
    {
        if ($this->check($firebase)) {
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if ($this->check($request->uid)) {
            $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/repositories-d0a35-firebase-adminsdk-0w9yb-282a9b97b1.json');
            $firebase = (new Factory)
                ->withServiceAccount($serviceAccount)
                ->create();
            $db = $firebase->getDatabase();
            $auth = $firebase->getAuth();
            $createUser = $auth->createUserWithEmailAndPassword($request['email'], $request['password']);
            $userRegister = [
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
                'country' => $request['country'],
                'school' => $request['school'],
                'field' => $request['field'],
                'firebase_uid' => $createUser->getIdToken()->getClaims()['user_id']->getValue()
            ];
            $user = \App\User::create($userRegister);
            $userRef = $db->getReference('users')->push(['display' => $userRegister['name'], 'name' => $user->id ]);
            $userKey = $userRef->getKey();
            //dd(gettype($createUser), $createUser->getIdToken()->getClaims()['user_id']->getValue() );
            return response($user, 200);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, $firebase)
    {
        return response()->json(User::where('firebase_uid', $firebase)->first(), 200);
    }


    public function adminChat(){
        return response()->json(User::where('role_id', 2)->first(), 200);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        \App\User::where('id', $user->id)->first()->update(['firebase_uid' => $request->firebase_uid]);
        return response('Update Successfully', 200);

    }

    public function updateUser(Request $request, $user, $firebase)
    {

        if($request->firebase_uid){
            if ($this->check($firebase)) {
                $usr =  \App\User::where('id', (int)$user)->first();
                $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/repositories-d0a35-firebase-adminsdk-0w9yb-282a9b97b1.json');
                $firebase = (new Factory)
                    ->withServiceAccount($serviceAccount)
                    ->create();
                $db = $firebase->getDatabase();
                $auth = $firebase->getAuth();
                $uid = $request->firebase_uid;
                if($usr->email !== $request->email){
                    $auth->changeUserEmail($uid, $request->email);
                    $usr->update(['email' => $request->email]);
                }
                if($request->password){
                    $auth->changeUserPassword($uid, $request->password);
                    $usr->update(['password' => $request->password]);
                }

            }
        }
        $update = [];
//                user original school not equal to school then change the school name
        if($usr->school !== $request->school){
            $update['school'] = $request->school;
        }
        if($usr->country !== $request->country){
            $update['country'] = $request->country;
        }
        if($usr->field !== $request->field){
            $update['field'] = $request->field;
        }
        if($update){
            $usr->update($update);
        }
        return response('Update Successfully', 200);



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, $firebase)
    {
        if($firebase){
            $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/repositories-d0a35-firebase-adminsdk-0w9yb-282a9b97b1.json');
            $fb = (new Factory)
                ->withServiceAccount($serviceAccount)
                ->create();
            $db = $fb->getDatabase();
            $auth = $fb->getAuth();
            $uid = $firebase;
            $updatedUser = $auth->disableUser($uid);
            $userId = User::where('id', $user->id)->where('firebase_uid', $firebase);
            if (!(empty($user->photo->file))) {
                unlink(public_path() . $user->photo->file);
            }
            $userId->delete();
            return response('Remove Successfully!');
        }

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
