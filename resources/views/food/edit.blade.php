@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center">Editar alimento</h2>
            <form action="{{route('update-food', $food)}}" method="POST" enctype="multipart/form-data" class="w-50 m-auto">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="food_name">Nome:</label>
                    <input type="text" class="form-control" id="food_name" name="food_name" value="{{$food->food_name}}" required>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantidade:</label>
                    <input type="number" step="0.01" class="form-control" id="quantity" name="quantity" value="{{$food->quantity}}" required>
                </div>
                <div class="form-group">
                    <label for="measure_type">Medida (g, kg, fatia, pedaço, etc):</label>
                    <input type="text" placeholder="fatia" class="form-control" id="measure_type" name="measure_type" value="{{$food->measure_type}}" required>
                </div>
                <div class="form-group">
                    <label for="energy_value">Valor energético:</label>
                    <input type="number" step="0.01" class="form-control" id="energy_value" name="energy_value" value="{{$food->energy_value}}" required>
                </div>
                <div class="form-group">
                    <label for="carbohydrates">Carboidratos:</label>
                    <input type="number" step="0.01" class="form-control" id="carbohydrates" name="carbohydrates" value="{{$food->carbohydrates}}" required>
                </div>
                <div class="form-group">
                    <label for="sugars">Açúcares:</label>
                    <input type="number" step="0.01" class="form-control" id="sugars" name="sugars" value="{{$food->sugars}}">
                </div>
                <div class="form-group">
                    <label for="proteins">Proteínas:</label>
                    <input type="number" step="0.01" class="form-control" id="proteins" name="proteins" value="{{$food->proteins}}">
                </div>
                <div class="form-group">
                    <label for="fats">Gordura:</label>
                    <input type="number" step="0.01" class="form-control" id="fats" name="fats" value="{{$food->fats}}">
                </div>
                <div class="form-group">
                    <label for="dietary_fiber">Fibra:</label>
                    <input type="number" step="0.01" class="form-control" id="dietary_fiber" name="dietary_fiber" value="{{$food->dietary_fiber}}">
                </div>
                <div class="form-group">
                    <label for="sodium">Sódio:</label>
                    <input type="number" step="0.01" class="form-control" id="sodium" name="sodium" value="{{$food->sodium}}">
                </div>
                <div class="form-group">
                    <label for="other">Outros:</label>
                    <input type="number" step="0.01" class="form-control" id="other" name="other" value="{{$food->other}}">
                </div>

                <div class="form-group">
                    <label for="image">Imagem:</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>

                <div class="my-2">
                    <h2>Associar ao tipo de alimento</h2>
                    <hr>
                    @foreach (App\Models\Group::get() as $item)
                        <div class="form-check">
                            <input class="form-check-input" type="radio"
                             name="group_type" id="group_type_{{$item->id}}"
                             value="{{$item->id}}"
                             {{ $item->id == $selectedGroup ? 'checked' : '' }}
                             required>
                            <label class="form-check-label" for="group_type_{{$item->id}}">
                                {{$item->group_type}}
                            </label>
                        </div>
                    @endforeach
                </div>

                <button type="submit" class="btn btn-success">Enviar</button>
            </form>
        </div>
    </div>

@endsection
