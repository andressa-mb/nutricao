<?php

use App\Http\Models\Profile;
use App\Http\Models\ProfileHistory;
use App\User;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Criar perfis apenas para usuários que não têm
        $usersWithoutProfile = User::doesntHave('profile')->get();

        foreach ($usersWithoutProfile as $user) {
            $profile = factory(Profile::class)->create([
                'user_id' => $user->id // Usar usuário existente
            ]);

            // Criar histórico para o perfil
            factory(ProfileHistory::class, rand(1, 5))->create([
                'profile_id' => $profile->id
            ]);
        }
    }
}
