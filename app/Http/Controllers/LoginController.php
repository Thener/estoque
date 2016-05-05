<?php

namespace App\Http\Controllers;

use Request;
use Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller {
    
	public function login() {
		
		return view('login/formLogin');
	}
	
	public function logar() {
		
		$credenciais = Request::only('email', 'password');
		
		if (Auth::attempt($credenciais)) {
			return redirect('/home');
		}
		
		Session::flash('message','Dados inválidos. Favor tentar novamente!');
		
		return redirect('/login');
	}
	
	public function logout() {

		Auth::logout();
		Session::flush();
		return redirect('/login');
	}
	
	
}
