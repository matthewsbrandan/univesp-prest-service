<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

use Exception;

class UserController extends Controller
{
  public function register(){
    if(auth()->user()) return $this->toast(
      redirect()->route('home'),
      'Você já está logado',
      'info',
    );
    
    return view('auth.register');
  }
  public function store(Request $request){
    $errors = [];
    if(!$request->name) $errors[]= "O nome é obrigatório";
    if(!$request->email) $errors[]= "O email é obrigatório";
    if(!$request->password) $errors[]= "A senha é obrigatória";

    if(count($errors) > 0) return $this->sweet(
      redirect()->back(),
      'Alguns erros foram encontrados:<br/>- ' . implode(
        '<br/>- ',
        $errors
      ),
      'danger',
      'Cadastrar Usuário'
    );

    if(User::whereEmail($request->email)->first()) return $this->sweet(
      redirect()->back(),
      'Este email já está sendo utilizado',
      'danger',
      'Cadastrar Usuário'
    );

    $username = User::generateUsername($request->name);

    $data = [
      'username' => $username,
      'name' => $request->name,
      'email' => $request->email,
      'password' => bcrypt($request->password)
    ];

    try{
      $user = User::create($data);
      \Auth::login($user);
    }catch(Exception $e){
      return $this->sweet(
        redirect()->back(),
        "Houve um erro inesperado ao tentar criar o usuário.<br/> Tente novamente, e caso retorne 'Email já está sendo utilizado' tente logar ou pedir recuperação de senha.",
        'danger',
        'Cadastrar Usuário'
      );
    }

    return redirect()->route('home');
  }
  public function profile($username = null){
    if($username){
      if(!$user = User::whereUsername($username)->first()) return $this->sweet(
        redirect()->back(),
        'Usuário não encontrado',
        'danger',
        'Perfil'
      );

      return view('profile.index',['user' => $user]);
    }
    
    $user = auth()->user();
    $works = auth()->user()->getWorks();
    $applicant_works = auth()->user()
      ->applicant_works()
      ->take(4)
      ->get();

    return view('profile.index',[
      'user' => $user,
      'works' => $works,
      'applicant_works' => $applicant_works
    ]);
  }
}
