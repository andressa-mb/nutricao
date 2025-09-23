<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateDataToStartSystem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      //USUÁRIOS
      DB::table('users')->insert([
        [
          'name' => 'Pedro Martins', 'email' => 'pedro@email.com', 'birthday' => '1998-03-15', 'sex' => 'M', 'password' => Hash::make('12345678'), "created_at" => now()->subDays(4)->format('Y-m-d'), "updated_at" => now()->subDays(2)->format('Y-m-d')
        ],
        [
          'name' => 'Mariana Lima', 'email' => 'mariana123@email.com', 'birthday' => '2001-07-21', 'sex' => 'F', 'password' => Hash::make('12345678'), "created_at" => now()->subDays(4)->format('Y-m-d'), "updated_at" => now()->subDays(2)->format('Y-m-d')
        ],
        [
          'name' => 'Caio Silva', 'email' => 'caio@email.com', 'birthday' => '1996-02-17', 'sex' => 'M', 'password' => Hash::make('12345678'), "created_at" => now()->subDays(3)->format('Y-m-d'), "updated_at" => now()->subDays(3)->format('Y-m-d')
        ],
      ]);

      DB::table('user_roles')->insert([
        ['user_id' => 2, 'role_id' => 2],
        ['user_id' => 3, 'role_id' => 2],
        ['user_id' => 4, 'role_id' => 2],
      ]);

      //FOOD
      DB::table('foods')->insert([
        [
            'food_name' => "Brigadeiro",
            "quantity" => 20.0,
            "measure_type" => "g",
            "energy_value" => 122.0,
            "carbohydrates" => 135.6,
            "sugars" => 2.0,
            "proteins" => 2.0,
            "fats" => null,
            "dietary_fiber" => null,
            "sodium" => 0.5,
            "other_value" => null,
            "other_type" => null,
            "created_at" => now()->subDays(5)->format('Y-m-d'),
            "updated_at" => now()->subDays(5)->format('Y-m-d')
        ],
        [
            "food_name" => "Amendoim",
            "quantity" => 20.0,
            "measure_type" => "unidades",
            "energy_value" => 95.1,
            "carbohydrates" => 2.98,
            "sugars" => 3.0,
            "proteins" => 3.5,
            "fats" => 8.44,
            "dietary_fiber" => 1.25,
            "sodium" => 60.16,
            "other_value" => null,
            "other_type" => null,
            "created_at" =>  now()->subDays(5)->format('Y-m-d'),
            "updated_at" =>  now()->subDays(5)->format('Y-m-d')
        ],
        [
            "food_name" => "Pão francês",
            "quantity" => 50.0,
            "measure_type" => "g",
            "energy_value" => 150.0,
            "carbohydrates" => 29.32,
            "sugars" => null,
            "proteins" => 4.0,
            "fats" => 1.22,
            "dietary_fiber" => 1.15,
            "sodium" => 324.0,
            "other_value" => null,
            "other_type" => null,
            "created_at" =>  now()->subDays(5)->format('Y-m-d'),
            "updated_at" =>  now()->subDays(5)->format('Y-m-d')
        ],
        [
            "food_name" => "Uva",
            "quantity" => 100.0,
            "measure_type" => "g",
            "energy_value" => 53.2,
            "carbohydrates" => 13.6,
            "sugars" => 1.2,
            "proteins" => 0.7,
            "fats" => 0.21,
            "dietary_fiber" => 0.9,
            "sodium" => null,
            "other_value" => null,
            "other_type" => null,
            "created_at" =>  now()->subDays(5)->format('Y-m-d'),
            "updated_at" =>  now()->subDays(5)->format('Y-m-d')
        ],
      ]);

      //FOOD_GROUPS
      DB::table('food_groups')->insert([
          ['food_id' => 1, 'group_id' => 2],
          ['food_id' => 2, 'group_id' => 9],
          ['food_id' => 3, 'group_id' => 1],
          ['food_id' => 4, 'group_id' => 3],
      ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('data_to_start_system');
    }
}
