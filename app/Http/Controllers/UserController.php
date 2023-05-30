<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Traits\HttpResponseTrait;
use App\Models\User;
// use sms
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /*
    This controller is used for  users profile on database :

    */
    use HttpResponseTrait;

    public function index()
    {
        $user = User::findOrFail(Auth::id());
        return $this->success([
           'message'=>"User profile for user"."".$user->id,
           'user' => $user,

        ]);
    }

    public function store(StoreUserRequest $request)
    {
        DB::beginTransaction();
        try{
       $request->validated($request->all());
       $User = new User();
       $User->uid = DB::raw('md5(NOW())');
       $User->name = $request->name;
       $User->email = $request->email;
       $User->countryCode = $request->countryCode;
       $User->phone = $request->phone;
       $User->age = $request->age;
       $User->bio = $request->bio;
       $User->image = $request->image;
       $User->serverTimeFetchHelper = $request->serverTimeFetchHelper;
       $User->gender = $request->gender;
       $User->isAdmin = $request->isAdmin;
       $User->isSuperAdmin = $request->isSuperAdmin;

       $User->save();
    //    Auth::loginUsingId($User->id);
       DB::commit();
       return $this->success([
        'user' => $User,
        'message'=>"user created successfully",
        'token' => $User->createToken('API Token Of' . $User->email)->plainTextToken
    ]);
       }catch(\Exception $e) {
        DB::rollBack();
        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
        ], 500);

       }

    }





}
