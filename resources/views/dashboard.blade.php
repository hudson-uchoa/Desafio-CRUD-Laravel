@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1>Bem vindo, {{$userInfo-> name}}!</h1>
                @csrf
                <h2>Seus dados:</h2>
                <p>Email: {{auth()->user()-> email}}</p>
                <p>Idade: {{$userInfo-> age}}</p>
                <p>Senha: {{auth()->user()-> password}}</p>
            </div>
            <a href="{{url('/update/' . $userInfo-> user_id)}}" class="dashboard-buttons">
                <button class="btn btn-primary">Mudar dados</button>
            </a>

            <div class="dashboard-buttons">

                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Deletar conta
                </button>
            </div>
            <a href="{{route('logout.user')}}" class="dashboard-buttons">
                <button class="btn btn-primary">Sair</button>
            </a>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tem certeza que quer deletar?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Sua conta será deletada, não há volta.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <form action="{{route('delete.user', $userInfo->user_id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Sim</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection