@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12 d-flex justify-content-around align-self-center">
            <div class="card my-3" style="width: 22rem;">
                @if (!is_null($user->image))
                    <img class="card-img-top" src="{{Storage::url($user->image->url)}}" alt="{{$user->image->id}}">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{$user->name}}</h5>
                    <ul>
                        <input type="hidden" value="{{$user->id}}" name="{{$user->id}}">
                        <li><strong>Nome: </strong>{{$user->name}}</li>
                        <li><strong>E-mail: </strong>{{$user->email}}</li>
                        <li><strong>Data de nascimento: </strong>{{$user->birthday->format('d/m/Y')}}</li>
                        <li><strong>Sexo: </strong>{{$user->sex == 'F' ? 'Feminino' : 'Masculino'}}</li>
                        <li><strong>Inscrito desde: </strong> {{$user->created_at->format('d/m/Y')}}</li>
                        <li><strong>Perfil: </strong>{{$user->roles()->first()->role_name}}</li>
                        <li><strong>Senha: </strong>{{str_replace($user->password, "*********", $user->password)}}</li>
                    </ul>
                </div>
                <div class="card-footer d-flex justify-content-around">
                    <a href="{{route('edit-user', $user)}}" class="btn btn-warning">Editar</a>
                    <form action="{{route('delete-user', $user)}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger">Excluir conta</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
