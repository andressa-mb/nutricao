@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center">Novas medidas</h2>
            <form action="{{route('save-measures', $profile)}}" method="POST" enctype="multipart/form-data" class="m-auto w-50">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" id="user_name" value="{{$profile->user->name}}" name="user_name" readonly>
                    <input type="text" class="form-control" id="user_id" value="{{$profile->user_id}}" name="user_id" hidden>
                </div>
                <div class="form-group">
                    <label for="weight">Peso atual:</label>
                    <input type="number" step="0.01" placeholder="69" class="form-control" id="weight" name="weight" value="{{$profile->weight}}" required>
                </div>
                <div class="form-group">
                    <label for="metabolism">Metabolismo:</label>
                    <input type="number" step="0.01" placeholder="1658" class="form-control" id="metabolism" name="metabolism" value="{{$profile->metabolism}}">
                </div>
                <div class="form-group">
                  <label for="image">Imagem:</label>
                  <input type="file" class="form-control" id="image" name="image">
                </div>
                <button type="submit" class="btn btn-primary">Atualizar</button>
            </form>
        </div>
    </div>

@endsection
