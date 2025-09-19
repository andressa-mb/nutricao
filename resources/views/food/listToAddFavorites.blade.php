@extends('layouts.app')
@section('content')
  <div class="row">
    <div class="col-12">
      {{ $foods->links() }}
    </div>
    <div class="col-12 py-2 my-2 bg-dark text-white text-center">
      <h2>Selecionar meus alimentos favoritos</h2>
    </div>
    <div class="col-12 d-flex justify-content-center">
      <form action="{{ route('save-favorite-foods') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">#</th>
              <th scope="col">Imagem</th>
              <th scope="col">Nome</th>
              <th scope="col">Quantidade</th>
              <th scope="col">Valor Energético (kcal)</th>
              <th scope="col">Carboidratos (g)</th>
              <th scope="col">Açúcares (g)</th>
              <th scope="col">Proteínas (g)</th>
              <th scope="col">Gorduras (g)</th>
              <th scope="col">Fibras (g)</th>
              <th scope="col">Sódio (mg)</th>
              <th scope="col">Outros (g)</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($foods as $food)
              <tr class="text-center">
                <th scope="row">{{ $food->id }}</th>
                <td>
                  <input
                    type="checkbox"
                    id="name_food_{{ $food->id }}"
                    name="foods[]"
                    value="{{ $food->id }}"
                    class="mr-2"
                  >
                </td>
                <td>
                  @if (!is_null($food->image))
                    <img src="{{ Storage::url($food->image->url) }}" alt="{{ $food->image->url }}" width="75" class="rounded">
                  @endif
                </td>
                <td>{{ $food->food_name }}</td>
                <td>{{ $food->quantity }} {{ $food->measure_type }}</td>
                <td>{{ $food->energy_value }} kcal</td>
                <td>{{ $food->carbohydrates }} g</td>
                <td>{{ $food->sugars }} g</td>
                <td>{{ $food->proteins }} g</td>
                <td>{{ $food->fats }} g</td>
                <td>{{ $food->dietary_fiber }} g</td>
                <td>{{ $food->sodium }} mg</td>
                <td>{{ $food->other_value }} {{ $food->other_type }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Enviar</button>
      </form>
    </div>
  </div>
@endsection
