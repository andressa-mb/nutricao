<?php

use App\Http\Models\Food;
use App\Http\Models\FoodType;
use App\Http\Models\Image;
use App\User;
use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Food::class, 15)->create()->each(function ($food) {
            // Criar food_type para cada alimento, usando o food existente
            factory(FoodType::class)->create([
                'food_id' => $food->id,
            ]);

            if (method_exists($food, 'users')) {
                $users = User::inRandomOrder()->limit(rand(1, 5))->pluck('id');
                $food->users()->sync($users);
            }

            // Adicionar imagem para alguns alimentos
            if (rand(0, 1)) {
                factory(Image::class)->create([
                    'img_id' => $food->id,
                    'img_parent' => Food::class
                ]);
            }
        });
    }
}
