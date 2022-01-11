<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:100',
            'confirm_password' => 'required|same:password',
            'role' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $user->assignRole($request->role);

        return response()->json($user);
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()], 422);
        }

        $user=User::where('email', $request->email)->first();

        if($user) {
            if(Hash::check($request->password, $user->password)) {
                $token = $user->createToken('auth-token')->plainTextToken;

                return response()->json(['access_token' => $token, 'user' => $user, 'role' => $user->getRoleNames()]);
            } else {
                return response()->json(['error' => "Incorrect credentials"], 400); 
            }
        }
        else {
            return response()->json(['error' => "Incorrect credentials"], 400);
        }

    } 
}
