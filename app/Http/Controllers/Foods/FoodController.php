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
     * Lista dos alimentos existentes no sistema, podendo adicioná-los aos favoritos.
     */
    public function listFoods(){
        return view('food.listFoods', ['foods' => Food::paginate()]);
    }
    //TODOS OS USUÁRIOS
    /**
     * Lista dos alimentos favoritos do usuário.
     */
    public function myFavoriteFoods(){
        return view('food.myFavorites');
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
     * Deleta alimento favorito do usuário autenticado.
     */
    public function destroyFavoriteFood(int $foodId)
    {
      $user = $this->user();
      $user->foods()->detach($foodId);

      return back()->with('message', 'Excluído com sucesso.');
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
        return redirect()->route('list-foods')->with('message', 'Atualizado com sucesso.');
    }

    /**
     * ADMIN: Remove o alimento selecionado.
     */
    public function destroy(int $foodId)
    {
      if(!$this->isAdmin()){
          return redirect()->route('main-page')->withErrors('Página apenas para administradores.');
      }
      Food::findOrFail($foodId)->delete();
      return redirect()->route('list-foods')->with('message', 'Excluído com sucesso.');
    }
}
