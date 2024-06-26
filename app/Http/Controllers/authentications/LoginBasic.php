<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-login-basic');
  }

  public function login(Request $request)
  {
    $params = $request->validate(['email'=>'required|email','password'=>'required']);
    if(Auth::attempt(['email'=>$params['email'],'password'=>$params['password']])){
      return redirect()->route('document.index');
    }
    return back()->withErrors(['error'=>'Email or Password entered wrong']);
  }

  public function logout(Request $request)
  {
    auth('web')->logout();
    return redirect()->route('dashboard-analytics');
  }

}
