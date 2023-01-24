<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{

	public function login(Request $request)
	{
	  $this->validate($request, [
	  'username' => 'required',
	  'password' => 'required'
	 ]);

          $user=User::where('username', $request->input('username'))->first();
          if (is_null($user)){
             return response('User not found', 400);
          }
	  if($request->input('password') == $user->password){
	   // you can use any logic to create the apikey. You can use md5 with other hash function, random shuffled string characters also
           session_start();
           $_SESSION["username"] = $request->username;
           return response('You are now logged in', 200);
	  }
          return response('Incorrect password', 400);
	}

	public function register(Request $request)
	{
	  $this->validate($request, [
	  'username' => 'required',
	  'password' => 'required'
	 ]);
	if (is_null(User::where('username', $request->input('username'))->first())){
	    $user = new User;
            $user->username = $request->username;
            $user->password = $request->password;
            $user->save();
            return response('Created new user', 200);
	}
        return response('Username already exists', 400);
	}
}
?>
