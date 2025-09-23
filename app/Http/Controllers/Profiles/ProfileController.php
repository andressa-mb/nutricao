<?php

namespace App\Http\Controllers\Profiles;

use App\Http\Controllers\Admin\AdminController as Controller;
use App\Http\Controllers\Traits\Images\ImageStorage;
use App\Http\Requests\Profiles\ProfileRequest;
use App\Models\Profile;
use Illuminate\Http\Request;
use Throwable;

class ProfileController extends Controller
{
  use ImageStorage;

  /**
   * Medida inicial do usuário e seu histórico de medidas (se houver)
   */
  public function index()
  {
      if($this->user->profile){
          $startWeight = floatval($this->user->profile->weight);
          $progressToAchieve = ($startWeight - floatval($this->user->profile->goal)) * 100;
          if($this->user->profile->evolutions()->exists()){
              $currentWeight = $this->user->profile->evolutions()->orderByDesc('id')->first()->weight_current;
              $currentProgress = ($startWeight - $currentWeight) * 100;
              $progressPercentage = ( $currentProgress * 100 ) / $progressToAchieve;
          }
      }
      return view('profile.index', ['progressPercentage' => $progressPercentage ?? 0, 'currentWeight' => $currentWeight ?? 0]);
  }

  /**
   * Form de criação do perfil inicial (perfil único)
   */
  public function create()
  {
      return view('profile.create');
  }

  /**
   * Salvar o perfil inicial do usuário (perfil único)
   */
  public function store(ProfileRequest $request)
  {
      $validated = $request->validated();
      $profile = $this->user()->profile()->create($validated);

      if ($request->hasFile('image')) {
        $path = $this->editOrCreateImage($request->image, $profile);

        $profile->image()->create([
            'url' => $path,
        ]);
      }
      return redirect()->route('main-page')->with('message', 'Sucesso, perfil adicionado.');
  }

  /**
   * Form de criação da evolução de perfil
   */
  public function createProfileEvolution()
  {
      $profile = $this->user()->profile;
      return view('profile.evolution_create', ['profile' => $profile]);
  }

  /**
   * Salvar a evolution de perfil
   */
  public function storeProfileEvolution(Request $request)
  {
      try{
          $user = $this->user();

          $validated = $request->validate([
              'weight' => 'required|numeric',
              'metabolism' => 'nullable|numeric'
          ]);

          $profHistory = $user->profile->evolutions()
          ->create([
              'weight_current' => $validated['weight'],
              'metabolism_current' => $validated['metabolism'] ?? null,
          ]);

          if ($request->hasFile('image')) {
            $path = $this->editOrCreateImage($request->image, $profHistory);

            $profHistory->image()->create([
                'url' => $path,
            ]);
          }

          return redirect()->route('my-body-profile')->with('message', 'Atualizado perfil com sucesso.');

      }catch(Throwable $e){
          return redirect()->back()->withErrors($e->getMessage());
      }
  }

  /**
   * Remove o profile e todas as evolutions se houver
   */
  public function destroy()
  {
      $profileToDelete = Profile::find($this->user()->profile->id);

      if(!is_null($profileToDelete->image)){
        $this->deleteImage($profileToDelete);
      }
      $profileToDelete->delete();

      return redirect()->route('main-page')->with('message', 'Excluído com sucesso.');
  }

  /**
   * Remove o profileEvolution selecionado
   */
  public function destroyEvolution(int $id)
  {
      $evolutionToDelete = $this->user()->profile->evolutions()->find($id);
      if(!is_null($evolutionToDelete->image)){
        $this->deleteImage($evolutionToDelete);
      }
      $evolutionToDelete->delete();

      return redirect()->route('main-page')->with('message', 'Excluído com sucesso.');
  }
}
