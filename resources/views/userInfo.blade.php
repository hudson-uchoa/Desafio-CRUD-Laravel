@extends('layouts.main')

@section('title', 'Terminar cadastro')

@section('content')

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1>Complete seu cadastro</h1>

                <form action="{{route('create.data')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputText">Nome:</label>
                        <input type="text" class="form-control" placeholder="Digite seu nome" required name="name" id="exampleInputText" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputAge">Idade:</label>
                        <input type="number" placeholder="Digite sua idade" required name="age" id="exampleInputAge" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Enviar</button>
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