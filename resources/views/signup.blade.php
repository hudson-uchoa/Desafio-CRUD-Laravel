@extends('layouts.main')

@section('title', 'Cadastrar')

@section('content')

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1>Cadastre-se</h1>

                <form action="{{route('create.user')}}" method="POST" id="forms">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail">Email:</label>
                        <input type="email" class="form-control" placeholder="Digite seu email" required name="email" id="exampleInputEmail" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Senha:</label>
                        <input type="password" placeholder="Digite sua senha" required name="password" id="exampleInputPassword1" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword2">Confirmar senha:</label>
                        <input type="password" placeholder="Digite sua senha novamente" required name="confirmPass" id="exampleInputPassword2" class="form-control">
                    </div>
                    <div class="buttons">
                        <button type="submit" class="btn btn-primary" id="button">Criar conta</button>

                        <a href="{{route('login')}}">Já tem conta? Entrar</a>
                    </div>
                </form>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if(session('danger'))
                <div class="alert alert-danger">
                    {{session('danger')}}
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection