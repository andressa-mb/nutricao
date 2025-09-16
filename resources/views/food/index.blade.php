@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="mx-2 col-12">
            <a href="{{route('create-food')}}" class="btn btn-success">Criar novo alimento</a>
            <a href="{{route('list-foods')}}" class="btn btn-primary">Alimentos Favoritos</a>
        </div>

        <div class="col-12">
            {{ $foods->links() }}
        </div>

        <div class="col-12 d-flex flex-wrap justify-content-around align-items-center">
            @foreach ($foods as $food)
                @foreach ($food->groups as $group)
                    <div class="card my-3" style="width: 18rem;">
                        @if (!is_null($food->image))
                            <img class="card-img-top" src="{{Storage::url($food->image->url)}}" alt="{{$food->image->id}}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{$food->food_name}} - {{$group->group_type}}</h5>
                            <p class="card-text">Informação nutricional</p>
                            <ul>
                                <li><strong>Quantidade: </strong>{{$food->quantity}} {{$food->measure_type}}</li>
                                <li><strong>Valor energético: </strong>{{$food->energy_value}}</li>
                                <li><strong>Carboidratos: </strong> {{$food->carbohydrates}}</li>
                                <li><strong>Açúcar: </strong>{{$food->sugars}}</li>
                                <li><strong>Proteínas: </strong>{{$food->proteins}}</li>
                                <li><strong>Gordura: </strong>{{$food->fats}}</li>
                                <li><strong>Fibra: </strong>{{$food->dietary_fiber}}</li>
                                <li><strong>Sódio: </strong>{{$food->sodium}}</li>
                                <li><strong>Outros: </strong>{{$food->other}}</li>
                            </ul>
                        </div>
                        <div class="card-footer d-flex justify-content-around">
                            <a href="{{route('edit-food', $food)}}" class="btn btn-warning">Editar</a>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalExclusao" data-food="{{$food->food_name}}">Excluir</button>


                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>

    <div class="modal fade" id="modalExclusao" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Excluir alimento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Tem certeza que deseja excluir o alimento:
                        <strong id="foodName"></strong>
                    </p>
                    <p class="text-danger">Essa ação não poderá ser desfeita.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cancelar
                    </button>
                    <form action="{{route('delete-food', $food)}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger">Excluir</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#modalExclusao').on('show.bs.modal', function (event){
            var btn = $(event.relatedTarget);
            var foodName = btn.data('food');
            $('#foodName').text(foodName);
        })
    })
</script>
@endpush
