<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
  /**
   * Handle an authentication attempt.
   *
   * @param  \Illuminate\Http\Request $request
   *
   * @return Response
   */
  public function authenticate(Request $request){
    if(Auth::check()) Auth::logout();

    if($request->google_id) return $this->handleLoginWithGoogle($request);

    if(!User::whereEmail($request->email)->first()) return $this->sweet(
      redirect()->back(),
      'Email não encontrado',
      'danger',
      'Login'
    );

    $credentials = $request->only('email', 'password');

    if (!Auth::attempt($credentials, true)) return $this->sweet(
      redirect()->back(),
      'Senha inválida',
      'danger',
      'Login'
    );

    // auth()->user()->closeTunel();
    
    return redirect()->route('home');
  }
  public function login(){
    if(auth()->user()) return $this->toast(
      redirect()->route('home'),
      'Você já está logado',
      'info'
    );
    return view('auth.login');
  }
  public function authenticateEmail(Request $request){
    if(!$user = User::whereEmail($request->email)->first()) return redirect()
      ->route('register',['email' => $request->email]);
    if(!$user->password) return redirect()->route('index')->with(
      'message',
      'Você ainda não possui senha cadastrada, efetue o login com o google e cadastre sua primeira senha'
    );
    return view('login',['email' => $request->email]);
  }
  public function logout(){
    Auth::logout();
    return redirect()->route('login');
  }
  protected function handleLoginWithGoogle(Request $request){
    if($user = User::whereEmail($request->email)->first()){
      if($user->google_id == $request->google_id){
        $user->closeTunel();
        Auth::login($user, true);
        return redirect()->route('home');
      }else return redirect()->back()->with(
        'message', 'Erro de autenticação, Id do google inválido'
      );
    }

    $user = User::create([
      'email' => $request->email,
      'name' => $request->name,
      'profile' => $request->profile ?? null,
      'google_id' => $request->google_id,
    ]);
    Auth::login($user, true);

    return redirect()->route('register')->with(
      'message', 'Faltam apenas alguns passos para finalizar o seu cadastro'
    );
  }
}