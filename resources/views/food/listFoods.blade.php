@extends('layouts.app')
@section('content')
<div class="row">
    @component('components.modals.modal-delete', ['titleModal' => 'Excluir alimento'])
      <p>Tem certeza que deseja excluir o alimento:
        <strong id="foodName"></strong>
      </p>
    @endcomponent

    <div class="mx-2 col-12">
      @if ($is_admin)
          <a href="{{route('create-food')}}" class="btn btn-success">Criar novo alimento</a>
      @endif
      <a href="{{route('my-favorite-foods')}}" class="btn btn-primary">Alimentos Favoritos</a>
    </div>

    <div class="col-12 py-2 my-2 bg-dark text-white text-center">
      <h2>Alimentos</h2>
    </div>
    <div class="col-12">
      {{ $foods->links() }}
    </div>
    <div class="col-12 d-flex justify-content-center">
      <form action="{{ route('save-favorite-foods') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <table class="table table-bordered table-striped">
          <thead class="thead">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Favoritos</th>
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
              @if ($is_admin)
                <th scope="col">Ações</th>
              @endif
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
                    @foreach ($user->foods as $item)
                      @if ($item->pivot->food_id == $food->id)
                        checked
                      @endif
                    @endforeach
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
                @if ($is_admin)
                  <td>
                    <a href="{{route('edit-food', $food)}}" class="btn btn-warning m-1">
                      @include('icons.edit')
                    </a>
                    <a class="btn btn-danger m-1" data-toggle="modal" data-target="#modalExclusao" data-route="{{route('delete-food', $food)}}" data-food="{{$food->food_name}}">
                      @include('icons.delete')
                    </a>
                  </td>
                @endif
              </tr>
            @endforeach
          </tbody>
        </table>
        <button type="submit" class="btn btn-success">Adicionar aos favoritos</button>
      </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
      $('#modalExclusao').on('show.bs.modal', function (event){
          var btn = $(event.relatedTarget);
          var foodName = btn.data('food');
          var route = btn.data('route');
          $('#foodName').text(foodName);
          $('form').attr('action', route);
      })
    })
</script>
@endpush
