@extends('layouts.main')

@section('title', 'Alterar dados')

@section('content')

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1>Edite seus dados</h1>

                <form action="{{route('update.user', $userInfo->user_id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group" id="forms">
                        <label for="exampleInputText">Nome:</label>
                        <input type="text" class="form-control" placeholder="Digite um novo nome" required name="name" id="exampleInputText" aria-describedby="textHelp" value="{{$userInfo->name}}">
                    </div>
                    <div class="form-group" id="forms">
                        <label for="exampleInputAge">Idade:</label>
                        <input type="number" placeholder="Digite uma nova idade" required name="age" id="exampleInputAge" class="form-control" value="{{$userInfo->age}}">
                    </div>
                    <div class="form-group" id="forms">
                        <label for="exampleInputEmail">Email:</label>
                        <input type="email" placeholder="Digite um novo email" required name="email" id="exampleInputEmail" class="form-control" value="{{auth()->user()-> email}}">
                    </div>
                    <div class="form-group" id="forms">
                        <label for="exampleInputPassword">Senha:</label>
                        <input type="password" placeholder="Digite uma nova senha" required name="password" id="exampleInputPassword" class="form-control">
                    </div>
                    <div class="form-group" id="forms">
                        <label for="exampleInputPassword2">Confirmar senha:</label>
                        <input type="password" placeholder="Digite uma a nova senha novamente" required name="confirmPass" id="exampleInputPassword2" class="form-control">
                    </div>
                    <div class="buttons">

                        <button type="submit" class="btn btn-primary">Editar</button>
                        <a href="{{url('/dashboard/' . $userInfo-> user_id)}}">
                            <button type="button" class="btn btn-secondary">Voltar</button>
                        </a>
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