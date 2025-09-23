@extends('layouts.app')
@section('content')
  <div class="row">
    @component('components.modals.modal-delete', ['titleModal' => 'Excluir alimento favorito'])
      <p>Tem certeza que deseja excluir:
        <strong id="foodName"></strong>? Lembre que é o seu favorito.
      </p>
    @endcomponent

    <div class="col-12 py-2 my-2 bg-dark text-white text-center">
      <h2>Meus alimentos favoritos</h2>
    </div>
    @if (!$user->foods()->exists())
      <div class="col-12 mx-2">
          <div class="p-3 my-3 border border-secondary shadow p-3 mb-5 bg-white rounded">
              <h3>Ainda não há nenhum alimento como favorito.</h3>

              <h5>Cadastre-se e monte uma dieta também com seus alimentos favoritos.</h5>
          </div>
      </div>

      <div class="col-12 mx-2">
          <a href="{{route('list-foods')}}" class="btn btn-success">Adicionar favoritos</a>
      </div>
    @endif

    @foreach ($user->foods as $myFavorite)
      <div class="card my-3 mx-3" style="width: 15rem;">
        @if (!is_null($myFavorite->image))
            <img class="card-img-top" src="{{Storage::url($myFavorite->image->url)}}" alt="{{$myFavorite->image->id}}">
        @endif
        <div class="card-body">
            <h5 class="card-title">{{$myFavorite->food_name}} - {{$myFavorite->groups()->first()->group_type}}</h5>
            <p class="card-text">Informação nutricional</p>
            <ul>
                <li><strong>Quantidade: </strong>{{$myFavorite->quantity}} {{$myFavorite->measure_type}}</li>
                <li><strong>Valor energético: </strong>{{$myFavorite->energy_value}}</li>
                <li><strong>Carboidratos: </strong> {{$myFavorite->carbohydrates}}</li>
                <li><strong>Açúcar: </strong>{{$myFavorite->sugars}}</li>
                <li><strong>Proteínas: </strong>{{$myFavorite->proteins}}</li>
                <li><strong>Gordura: </strong>{{$myFavorite->fats}}</li>
                <li><strong>Fibra: </strong>{{$myFavorite->dietary_fiber}}</li>
                <li><strong>Sódio: </strong>{{$myFavorite->sodium}}</li>
                <li><strong>Outros: </strong>{{$myFavorite->other_value}} {{$myFavorite->other_type}}</li>
            </ul>
        </div>
        <div class="card-footer d-flex justify-content-around">
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalExclusao" data-food="{{$myFavorite->food_name}}" data-route="{{route('delete-favorite', $myFavorite)}}">
              @include('icons.delete')
            </button>
        </div>
      </div>
    @endforeach
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
