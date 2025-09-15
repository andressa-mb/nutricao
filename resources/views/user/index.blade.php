@extends('layouts.app')
@section('content')
    @if ($is_admin)
        <div class="row justify-content-center align-items-center m-auto">
            <h3 class="col-12 text-center">Usuários Administradores</h3>
            @foreach ($users as $user)
                @if ($user->roles()->first()->role_name == 'ADMIN')
                    <div class="col mx-2">
                        @include('user.users')
                    </div>
                @endif
            @endforeach
        </div>
        <div class="row justify-content-center align-items-center m-auto">
            <h3 class="col-12 text-center">Usuários Standards</h3>
            @foreach ($users as $user)
                @if ($user->roles()->first()->role_name == 'STANDARD')
                    <div class="col">
                            @include('user.users')
                    </div>
                @endif
            @endforeach
        </div>
    @endif
@endsection
