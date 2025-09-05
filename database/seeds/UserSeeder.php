<?php

use App\Http\Models\Image;
use App\Http\Models\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_roles')->delete(); // Limpa tabela pivot
        DB::table('images')->where('img_parent', User::class)->delete(); // Limpa imagens de users
        User::query()->delete(); // limpa os usuários

        $adminRole = Role::admin()->first();
        $stdRole = Role::standard()->first();

        factory(User::class, 5)->create()->each(function ($user) use ($adminRole, $stdRole) {
            // Atribui um role para cada user
            if(method_exists($user, 'roles')){
                $user->roles()->sync(rand(0, 1) ? $adminRole->id : $stdRole->id);
            }

            // Adicionar imagens para alguns usuários
            if (rand(0, 1)) {
                factory(Image::class)->create([
                    'img_id' => $user->id,
                    'img_parent' => User::class
                ]);
            }
        });

        $this->command->info('Total users created: ' . User::count());
    }
}
