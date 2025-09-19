<?php

namespace App\Http\Controllers\Foods;

use App\Models\Food;
use App\Http\Controllers\Admin\AdminController as Controller;
use App\Http\Controllers\Traits\Images\ImageStorage;
use App\Http\Requests\Foods\FoodRequest;
use Illuminate\Http\Request;
use Throwable;

class FoodController extends Controller
{
    use ImageStorage;

    /**
     * Lista dos alimentos existentes no sistema.
     */
    public function listFoods(){
        return view('food.listFoods', ['foods' => Food::paginate()]);
    }
    //TODOS OS USUÁRIOS
    /**
     * Lista dos alimentos existentes para seleção dos favoritos.
     */
    public function addFavoriteFoods(){
        return view('food.listToAddFavorites', ['foods' => Food::paginate()]);
    }

    /**
     * Salva os alimentos favoritos do usuário autenticado.
     */
    public function storeFavoriteFood(Request $request)
    {
        try{
            $user = $this->user;
            if($request->filled('foods')){
                foreach($request->input('foods') as $foodId){
                    $user->foods()->attach($foodId);
                }

                return redirect()->route('main-page')->with('message', 'Alimentos adicionados como favoritos.');
            }else {
                return back()->with('warning', 'Nenhum alimento selecionado.');
            }

        }catch(Throwable $e){
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * ADMIN: lista de alimentos inseridos no sistema.
     */
    public function index()
    {
        if($this->isAdmin){
            return view('food.index', ['foods' => Food::paginate()]);
        } else {
            return redirect()->route('main-page')->withErrors('Página apenas para administradores.');
        }
    }

    /**
     * ADMIN: Página do formulário de criação de alimento.
     */
    public function create()
    {
        if(!$this->isAdmin()){
            return redirect()->route('main-page')->withErrors('Página apenas para administradores.');
        }
        return view('food.create');
    }

    /**
     * ADMIN: Grava um novo alimento no sistema.
     */
    public function store(FoodRequest $request){
        if(!$this->isAdmin()){
            return redirect()->route('main-page')->withErrors('Página apenas para administradores.');
        }

        $validated = $request->validated();
        $food = Food::create($validated);

        $food->groups()->attach($request->group_type);

        if ($request->hasFile('image')) {
            $path = $this->editOrCreateImage($request->image, $food);

            $food->image()->create([
                'url' => $path,
            ]);
        }

        return redirect()->route('main-page')->with('message', 'Inserido com sucesso.');
    }

    /**
     * ADMIN: Form de edição do food selecionado.
     */
    public function edit(int $id)
    {
        if(!$this->isAdmin()){
            return redirect()->route('main-page')->withErrors('Página apenas para administradores.');
        }
        $food = Food::findOrFail($id);
        $selectedGroup = $food->groups->first()->id ?? null;
        return view('food.edit', ['food' => $food, 'selectedGroup' => $selectedGroup]);
    }

    /**
     * ADMIN: Atualizar o alimento selecionado.
     */
    public function update(FoodRequest $request, int $foodId)
    {
        if(!$this->isAdmin()){
            return redirect()->route('main-page')->withErrors('Página apenas para administradores.');
        }

        $food = Food::find($foodId);
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $type = $food->image ? 'edit' : 'create';
            $path = $this->editOrCreateImage($request->image, $food);

            if ($type == 'edit'){
                $food->image()->update([
                    'url' => $path,
                ]);
            } else {
                $food->image()->create([
                    'url' => $path,
                ]);
            }
        }

        $groupId = $request->input('group_type');
        $food->groups()->sync([$groupId]);
        $food->update($validated);
        return redirect()->route('foods')->with('message', 'Atualizado com sucesso.');
    }

    /**
     * Remove o alimento selecionado.
     */
    public function destroy(int $foodId)
    {
        if(!$this->isAdmin()){
            return redirect()->route('main-page')->withErrors('Página apenas para administradores.');
        }

        Food::findOrFail($foodId)->delete();
        return redirect()->route('foods')->with('message', 'Excluído com sucesso.');
    }
}
