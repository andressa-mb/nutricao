<div class="card my-3" style="width: 22rem;">
    @if (!is_null($user->image))
        <img class="card-img-top" src="{{Storage::url($user->image->url)}}" alt="{{$user->image->id}}">
    @endif
    <div class="card-body">
        <h5 class="card-title">{{$user->name}}</h5>
        <ul>
            <input type="hidden" value="{{$user->id}}" name="{{$user->id}}">
            <li><strong>Nome: </strong>{{$user->name}}</li>
            <li><strong>E-mail: </strong>{{$user->email}}</li>
            <li><strong>Data de nascimento: </strong>{{$user->birthday->format('d/m/Y')}}</li>
            <li><strong>Sexo: </strong>{{$user->sex == 'F' ? 'Feminino' : 'Masculino'}}</li>
            <li><strong>Inscrito desde: </strong> {{$user->created_at->format('d/m/Y')}}</li>
            <li><strong>Perfil: </strong>{{$user->roles()->first()->role_name}}</li>
            <li><strong>Senha: </strong>{{str_replace($user->password, "*********", $user->password)}}</li>
        </ul>
    </div>
    <div class="card-footer d-flex justify-content-around">
        <a href="{{route('edit-user', $user)}}" class="btn btn-warning">Editar</a>
        <button type="button" class="btn btn-danger" data-toggle="modal"
         data-target="#modalExclusao"
         data-user="{{$user->name}}"
         data-id="{{$user->id}}"
         data-route="{{route('delete-user', $user)}}">Excluir</button>
    </div>
</div>

 <div class="modal fade" id="modalExclusao" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Excluir usuário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Tem certeza que deseja excluir o usuário:
                    <strong id="userName"></strong>
                </p>
                <p class="text-danger">Essa ação não poderá ser desfeita.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Cancelar
                </button>
                <form id="deleteForm" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Excluir conta</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function () {
        $('#modalExclusao').on('show.bs.modal', function (event){
            var btn = $(event.relatedTarget);
            var userName = btn.data('user');
            var deleteRoute = btn.data('route');
            $('#userName').text(userName);
            $('#deleteForm').attr('action', deleteRoute);
        })
    })
</script>
@endpush
