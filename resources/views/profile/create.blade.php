@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center">Cadastro pessoal</h2>
            <form action="{{route('save-profile')}}" method="POST" enctype="multipart/form-data" class="w-50 m-auto">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" id="user_name" value="{{$user->name}}" name="user_name" readonly>
                    <input type="text" class="form-control" id="user_id" value="{{$user->id}}" name="user_id" hidden>
                </div>
                <div class="form-group">
                    <label for="weight">Peso:</label>
                    <input type="number" step="0.01" placeholder="69" class="form-control" id="weight" name="weight" required>
                </div>
                <div class="form-group">
                    <label for="height">Altura:</label>
                    <input type="number" step="0.01" placeholder="1.70" class="form-control" id="height" name="height" required>
                </div>
                <div class="form-group">
                    <label for="goal">Meta (peso):</label>
                    <input type="number" step="0.01" placeholder="60" class="form-control" id="goal" name="goal" required>
                </div>
                <div class="form-group">
                    <label for="metabolism">Metabolismo:</label>
                    <input type="number" step="0.01" placeholder="1910.50" class="form-control" id="metabolism" name="metabolism">
                </div>
                <div class="form-group">
                    <label for="image">Imagem:</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                <button type="submit" class="btn btn-success">Enviar</button>
            </form>
        </div>
    </div>

@endsection
