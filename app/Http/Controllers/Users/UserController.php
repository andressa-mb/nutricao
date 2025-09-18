<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Admin\AdminController as Controller;
use App\Http\Controllers\Auth\Traits\ValidatorUser;
use App\Http\Controllers\Traits\Images\ImageStorage;
use App\User;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    use ValidatorUser;
    use ImageStorage;
    use ConfirmsPasswords;
    /**
     * Lista de usuários cadastrados no sistema
     *
     */
    public function index()
    {
        if($this->isAdmin()){
            return view('user.index', ['users' => User::orderBy('id', 'desc')->get()]);
        }
        return redirect()->route('my-data')->withErrors('Somente o próprio usuário ou administrador tem autorização.');
    }

    /**
     * Visualização das informações do usuário logado
     *
     */
    public function show(Request $request)
    {
        return view('user.show');
    }

    /**
     * Form com os campos de edição do usuário selecionado
     *
     */
    public function edit(Request $request, int $userId)
    {
        if($request->user()->id == $userId || $this->isAdmin()){
            return view('user.edit', ['user' => User::find($userId)]);
        }
        return redirect()->route('my-data')->withErrors('Somente o próprio usuário ou administrador tem autorização.');

    }

    //Trait Validador do name e email, birthday
    protected function validator(array $data, $userId)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($userId)],
            'birthday' => ['required', 'date', 'after_or_equal:1900-01-01'],
            'sex' => ['required', 'string', 'size:1'],
        ]);
    }

    /**
     * Atualização do usuário selecionado
     *
     */
    public function update(Request $request, int $userId)
    {
        $userToEdit = User::find($userId);
        //ADMIN(autenticado) - pode trocar a role
        if($this->isAdmin()){
            $roleBool = $request->input('role') === 'ADMIN' ? true : false;
            if(!$roleBool) {
                $userToEdit->roles()->sync(2);
            } else {
                $userToEdit->roles()->sync($roleBool);
            }
        }

        //Somente o próprio USUÁRIO (dono do perfil) OU ADMIN, pode atualizar nome, email, nascimento e imagem
        if($this->user()->id == $userId || $this->isAdmin()){
            $data['name'] = $request->input('user_name');
            $data['email'] = $request->input('user_email');
            $data['birthday'] = $request->input('user_birthday');
            $data['sex'] = $request->input('sex');
            $this->validator($data, $userToEdit->id)->validate();

            if($request->has('image')){
                $this->validatorImage(['image' => $request->image])->validate();
                $type = $userToEdit->image ? 'edit' : 'create';
                $path = $this->editOrCreateImage($request->image, $userToEdit);

                if ($type == 'edit'){
                    $userToEdit->image()->update([
                        'url' => $path,
                    ]);
                } else {
                    $userToEdit->image()->create([
                        'url' => $path,
                    ]);
                }
            }

            $userToEdit->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'birthday' => $data['birthday'],
                'sex' => $data['sex'],
            ]);
        }
        return redirect()->route('my-data')->with('message', 'Atualizado com sucesso.');
    }

    /**
     * Solicitada troca de senha
     * View para confirmar senha do usuário logado antes da troca
    */
    public function confirmPassForm(){
        return view('auth.passwords.confirm');
    }

    /**
     * Trait da validação da senha
     * Redireciona para a view de alteração de senha
    */
    public function confirm(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());

        $this->resetPasswordConfirmationTimeout($request);
        return $request->wantsJson()
                    ? new JsonResponse([], 204)
                    : redirect()->route('password-change-form');
    }

    /**
     * View do form para alterar senha
    */
    public function changePasswordForm(){
        return view('auth.passwords.change_pass_form');
    }

    /**
     * Atualização de senha
    */
    public function updatePassword(Request $request){
        $this->validatorOnlyPassword($request->all())->validate();

        $user = $request->user();
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('main-page')->with('message', 'Senha alterada com sucesso!');
    }

    /**
     * Remove o usuário selecionado
     */
    public function destroy(int $userId)
    {
        if($this->userId() == $userId || $this->isAdmin()){
            $userToDelete = User::find($userId);

            if(!is_null($userToDelete->image)){
                $this->deleteImage($userToDelete);
            }

            $userToDelete->delete();
            return redirect()->route('main-page')->with('message', 'Usuário deletado com sucesso.');
        }

        return redirect()->route('my-data')->withErrors('Somente o próprio usuário ou administrador tem autorização para excluir.');

    }
}
