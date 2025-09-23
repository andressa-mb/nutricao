@extends('layouts.app')
@section('content')
    <div class="row">
        @if (!$user->profile)
            <div class="col-12 mx-2">
                <div class="p-3 my-3 border border-secondary shadow p-3 mb-5 bg-white rounded">
                    <h3>Ainda não tem um perfil cadastrado.</h3>

                    <h5>Cadastre-se e veja os benefícios:</h5>

                    <ul>
                        <li>Verificar seu IMC</li>
                        <li>Histórico das suas medidas</li>
                        <li>Melhor forma de informar a sua dieta</li>
                    </ul>
                </div>
            </div>

            <div class="col-12 mx-2">
                <a href="{{route('create-profile')}}" class="btn btn-success">Cadastrar meu perfil</a>
            </div>
        @else
            @component('components.modals.modal-delete', ['titleModal' => 'Excluir perfil'])
              <p>Tem certeza que deseja excluir o seu perfil?</p>
            @endcomponent
            <div class="col-12 py-2 bg-dark text-white text-center">
                <h2>Perfil de {{$user->name}}</h2>
            </div>
            <div class="col-12 my-3 mx-2">
                <h4>Atualizar medidas:</h4>
                <a href="{{ route('new-measures', $user->profile->id) }}" class="btn btn-primary">Novas medidas</a>
            </div>
            {{-- BARRA DE PROGRESSO --}}
            <div class="col-12 my-3">
                <h4 class="text-center">Meu progresso</h4>

                <div class="progress" style="height: 20px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{$progressPercentage}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$progressPercentage}}%;"><strong>{{number_format($progressPercentage, 2)}}%</strong></div>
                    {{-- VALOR QUE FALTA PRA ALCANÇAR --}}
                    <div class="progress-bar bg-warning" role="progressbar" style="width: {{100-$progressPercentage}}%; color:#000;" aria-valuenow="{{100-$progressPercentage}}" aria-valuemin="0" aria-valuemax="100"><strong>Falta: {{number_format(100-$progressPercentage), 2}}%</strong></div>
                </div>
                <div class="col-12 d-flex justify-content-between p-0">
                    <p>Peso inicial: {{$user->profile->weight}}kg</p>
                    <p>Peso atual: {{$currentWeight ?? $user->profile->weight}}kg</p>
                    <p>Objetivo: {{$user->profile->goal}}kg</p>
                </div>

            </div>
            {{-- PROFILE --}}
            <div class="col-3 border-right border-dark rounded-right align-content-center" style="border-right-width: 5px;">
                <div class="card border border-warning shadow p-3 mb-5 bg-white rounded" style="width: 18rem;">
                    <div class="card-header text-center">
                      <h5>
                          Iniciado em: {{$user->profile->created_at->format('d-m-Y')}}
                      </h5>
                      @if (!is_null($user->profile->image))
                        <img class="card-img-top rounded" src="{{Storage::url($user->profile->image->url)}}" alt="{{$user->profile->image->id}}">
                      @endif
                    </div>

                    <div class="card-body">
                        <p><strong>Peso:</strong> {{$user->profile->weight}} kg</p>
                        <p><strong>Altura:</strong> {{$user->profile->height}} cm</p>
                        <p><strong>Meta:</strong> {{$user->profile->goal}} kg</p>
                        <p><strong>Metabolismo:</strong> {{$user->profile->metabolism}}</p>
                        <p><strong>Data de criação:</strong> {{$user->profile->created_at->format('d/m/Y')}}</p>
                    </div>

                    <div class="card-footer d-flex justify-content-around">
                        <button type="button" class="btn btn-danger"
                           data-toggle="modal"
                           data-target="#modalExclusao"
                           data-route="{{route('delete-profile')}}"
                          >
                          @include('icons.delete')
                        </button>
                    </div>
                </div>
            </div>
            {{-- PROFILE EVOLUTION --}}
            <div class="col-9 m-auto d-flex justify-content-around flex-wrap">
                @foreach ($user->profile->evolutions()->orderBy('id', 'desc')->get() as $item)
                    <div class="card border border-info shadow p-3 mb-5 bg-white rounded" style="width: 18rem;">
                        <div class="card-header text-center">
                            <h4>
                                Medidas atualizadas em: {{$item->recorded_at}}
                            </h4>
                            @if (!is_null($item->image))
                              <img class="card-img-top rounded" src="{{Storage::url($item->image->url)}}" alt="{{$item->image->id}}">
                            @endif
                        </div>

                        <div class="card-body">
                            <p><strong>Peso:</strong> {{$item->weight_current}}kg</p>
                            <p><strong>Altura:</strong> {{$user->profile->height}}cm</p>
                            <p><strong>Meta:</strong> {{$user->profile->goal}}kg</p>
                            <p><strong>Metabolismo:</strong> {{$item->metabolism_current}}</p>
                            <p><strong>Data de criação:</strong> {{$item->recorded_at}}</p>
                        </div>

                        <div class="card-footer d-flex justify-content-around">
                          <button type="button" class="btn btn-danger"
                           data-toggle="modal"
                           data-target="#modalExclusao"
                           data-route="{{route('delete-profile-evolution', $item->id)}}"
                          >
                          @include('icons.delete')
                          </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#modalExclusao').on('show.bs.modal', function (event){
            var btn = $(event.relatedTarget);
            var deleteRoute = btn.data('route');
            $('form').attr('action', deleteRoute);
        })
    })
</script>
@endpush
