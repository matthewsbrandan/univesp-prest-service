@php
  $head_title = 'Cadastre-se';
@endphp
@extends('layout.app')
@section('content')
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        @include('layout.navbar',['navbar_options' => (object)[
          'mode' => 'external'
        ]])
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('{{ asset('assets/img/illustrations/illustration-signup.jpg') }}'); background-size: cover;">
              </div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
              <div class="card card-plain">
                <div class="card-header">
                  <h4 class="font-weight-bolder">Cadastrar-se</h4>
                  <p class="mb-0">Entre com seu email e senha para se cadastrar</p>
                </div>
                <div class="card-body">
                  <form role="form" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label d-none">Nome</label>
                      <input
                        type="text"
                        class="form-control"
                        name="name"
                        placeholder="Nome"
                        value="{{ old('name') }}"
                        required
                      >
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label d-none">Email</label>
                      <input
                        type="email"
                        class="form-control"
                        name="email"
                        placeholder="Email"
                        value="{{ old('email') }}"
                        required
                      >
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label d-none">Senha</label>
                      <input
                        type="password"
                        class="form-control"
                        name="password"
                        placeholder="Senha"
                        required
                      >
                    </div>
                    <div class="form-check form-check-info text-start ps-0">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                      <label class="form-check-label" for="flexCheckDefault">
                        Eu aceito os <a href="javascript:;" class="text-dark font-weight-bolder">Termos e Condições</a>
                      </label>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Cadastrar-se</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-2 text-sm mx-auto">
                    Já tem uma conta?
                    <a href="{{ route('login') }}" class="text-primary text-gradient font-weight-bold">Faça o Login</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection