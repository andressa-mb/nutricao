@extends('layouts.app')
@section('content')
    <div class="row mx-2 my-3">
        <div class="col-md-12 d-flex justify-content-between">
            <div class="top-left">
                <h2>Nutrição</h2>
            </div>
        </div>
    </div>
    <div class="row mx-2 my-3">
        <div class="w-100 d-flex flex-row flex-wrap justify-content-around align-items-center">
            <a href="{{route('my-data')}}" class="col p-5 m-2 border border-primary rounded bg-secondary text-center text-white text-decoration-none">
                Meus Dados
            </a>
            <a href="{{route('my-body-profile')}}" class="col p-5 m-2 border border-primary rounded bg-secondary text-center text-white text-decoration-none">
                Meu Perfil
            </a>
            <a href="{{route('list-foods')}}" class="col p-5 m-2 border border-primary rounded bg-secondary text-center text-white text-decoration-none">
                Alimentos
            </a>
            <a href="{{route('my-favorite-foods')}}" class="col p-5 m-2 border border-primary rounded bg-secondary text-center text-white text-decoration-none">
                Alimentos favoritos
            </a>
        </div>
    </div>
@endsection
