<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\User;
//use Validator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends BaseController
{
    public function register(Request $request)
    {
        $Validator = Validator::make($request->all(), [
            'name' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            // 'C_password' => 'required|same:password',
        ]);
        if ($Validator->fails()) {
            return view('home');
            // return $this->sendError('please validate error', $Validator->errors());
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('anas')->plainTextToken;
        $success['name'] = $user->name;
        $success['email'] = $user->email;
        return view('home',compact('success'));
        // return $this->sendResponse( $success,'user Registerd successullly ');
    }

    public function login(Request $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) //ـاكد أنه وضع باسسورد وايميل
        {
            $user = Auth::user();
            $success['token'] = $user->createToken('anas')->plainTextToken;
            $success['name'] = $user->name;
            $success['email'] = $user->email;
            return view('home',compact('success'));
            // return $this->sendResponse($success, 'user Login successullly ');
        } else {
            return view('welcome', ['error' => 'Unauthorised']);
        }
    }
}
