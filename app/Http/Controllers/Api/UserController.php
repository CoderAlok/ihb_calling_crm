<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use User;

class UserController extends Controller {
 /**
  * Method index
  *
  * @return void
  */
 public function index() {
  $data['title'] = "";
//   return view('')->with($data);
 }

 /**
  * Method login
  *
  * @param Request $request [explicite description]
  *
  * @return void
  */
 public function login(Request $request) {
  $validatedData = $request->validate([
   'email'    => ['required', 'email'],
   'password' => ['required', 'max:10'],
  ]);

  $user = User::where(['email' => $validatedData['email'], 'password' => $validatedData['password']])->first();
  if (!empty($user)) {
   $token   = $user->createToken('auth_token')->accessToken;
   $message = 'User logged in successfully.';
  } else {
   $token   = '';
   $message = 'Sorry, Wrong credentials.';
  }
  $data['data']    = $user;
  $data['token']   = $token;
  $data['message'] = $message;

  return response($data, 200);
 }

 /**
  * Method index
  *
  * @return void
  */
 public function show_register() {
  $data['title'] = "";
//   return view('')->with($data);
 }

 /**
  * Method register
  *
  * @param Request $request [explicite description]
  *
  * @return void
  */
 public function register(Request $request) {
  $validatedData = $request->validate([
   'name'     => 'required',
   'email'    => ['required', 'email'],
   'password' => ['required', 'confirmed'],
  ]);

  $user  = User::create($validatedData);
  $token = $user->createToken('auth_token')->accessToken;

  $data['user']    = $user;
  $data['token']   = $token;
  $data['message'] = 'User created successfully.';

  return response($data, 200);

 }

 /**
  * Method get_user
  *
  * @param Request $request [explicite description]
  *
  * @return void
  */
 public function get_user(Request $request, $id = null) {
  if (empty($id)) {
   $records         = [];
   $data['message'] = 'Sorry, no id was detected.';
   return response($data, 500);
  } else {
   $user = User::where(['id' => $id])->first();
   if (empty($user)) {
    $records = [];
    $message = 'Sorry, no user found.';
   } else {
    $records = $user;
    $message = 'User loaded successfuly.';
   }

   $data['data']    = $records;
   $data['message'] = $message;
   return response($data, 200);
  }
 }

}
