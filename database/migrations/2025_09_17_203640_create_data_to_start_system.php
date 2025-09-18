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
        //Quando lançar pelo sistema atualizar a numeração dos ids pelo sistema com o código abaixo
        // SELECT setval('users_id_seq', (SELECT MAX(id) FROM users) + 1);
        // SELECT setval('foods_id_seq', (SELECT MAX(id) FROM users) + 1);
        // SELECT setval('groups_id_seq', (SELECT MAX(id) FROM users) + 1);
        // SELECT setval('roles_id_seq', (SELECT MAX(id) FROM users) + 1);

        //USUÁRIOS
        DB::table('users')->insert([
            [
				'id' => 2, 'name' => 'Pedro Martins', 'email' => 'pedro@email.com', 'birthday' => '1998-03-15', 'password' => Hash::make('12345678')
			],
			[
				'id' => 3, 'name' => 'Mariana Lima', 'email' => 'mariana123@email.com', 'birthday' => '2001-07-21', 'password' => Hash::make('12345678')
			],
			[
				'id' => 4, 'name' => 'Caio Silva', 'email' => 'caio@email.com', 'birthday' => '1996-02-17', 'password' => Hash::make('12345678')
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
                'id' => 1,
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
                "created_at" => "2025-09-10",
                "updated_at" => "2025-09-10"
            ],
            [
                "id" => 2,
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
                "created_at" => "2025-09-10",
                "updated_at" => "2025-09-16"
            ],
            [
                "id" => 3,
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
                "created_at" => "2025-09-16",
                "updated_at" => "2025-09-16"
            ],
            [
              	"id" => 4,
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
                "created_at" => "2025-09-16",
                "updated_at" => "2025-09-17"
            ],
        ]);

        //FOOD_GROUPS
        DB::table('food_groups')->insert([
            ['id' => 1, 'food_id' => 1, 'group_id' => 2],
            ['id' => 2, 'food_id' => 2, 'group_id' => 9],
            ['id' => 3, 'food_id' => 3, 'group_id' => 1],
            ['id' => 4, 'food_id' => 4, 'group_id' => 3],
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
