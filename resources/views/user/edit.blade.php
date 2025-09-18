@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center">Editar dados</h2>
            <form action="{{route('update-user', $user)}}" method="POST" enctype="multipart/form-data" class="w-50 m-auto">
                @csrf
                @method('PUT')

                @if(!is_null($user->image))
                    <div class="d-flex justify-content-center">
                        <img class="rounded" width="100" height="100" src="{{Storage::url($user->image->url)}}" alt="{{$user->image->id}}">
                    </div>
                @endif
                <div class="form-group">
                    <label for="image">Imagem:</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>

                <div class="form-group">
                    <label for="food_name">Nome:</label>
                    <input type="text" class="form-control" id="user_name" name="user_name" value="{{$user->name}}" required>
                </div>
                <div class="form-group">
                    <label for="user_email">E-mail:</label>
                    <input type="email" class="form-control" id="user_email" name="user_email" value="{{$user->email}}" required>
                </div>
                <div class="form-group">
                    <label for="user_birthday">Data de nascimento:</label>
                    <input type="date" class="form-control" id="user_birthday" name="user_birthday" value="{{$user->birthday}}" required>
                </div>
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <div>
                        <a href="{{route('confirm-pass-form')}}" class="form-control btn btn-warning">Trocar senha</a>
                    </div>
                </div>
                @if($is_admin)
                    <div class="form-group">
                        <label for="role">Perfil:</label>
                        <select class="form-control" id="role" name="role">
                            <option selected>{{$user->roles()->first()->role_name}}</option>
                            @foreach (App\Models\Role::get() as $role)
                                <option>{{$role->role_name}}</option>
                            @endforeach
                        </select>
                    </div>
                @else
                    <label for="role">Perfil:</label>
                    <input type="text" class="form-control" id="role" name="role" value="{{$user->roles()->first()->role_name}}" readonly>
                @endif

                <div class="form-group text-center mt-3">
                    <button type="submit" class="btn btn-success">Enviar</button>
                </div>
            </form>
        </div>
    </div>

@endsection
