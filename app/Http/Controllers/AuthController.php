<?php

namespace App\Http\Controllers;

class AuthController extends Controller {
 /**
  * Method index
  *
  * @return void
  */
 public function index(Request $request) {
  $data['page_title'] = 'User | Login';
  return view('auth.login')->with($data);
 }

 /**
  * Method index
  *
  * @return void
  */
 public function register(Request $request) {
  $data['page_title'] = 'User | Register';
  return view('auth.login')->with($data);
 }
}
