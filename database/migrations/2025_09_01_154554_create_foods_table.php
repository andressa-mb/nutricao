<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foods', function (Blueprint $table) {
            $table->id();
            $table->string('food_name', 150);
            $table->double('quantity');
            $table->string('measure_type', 30);
            $table->double('energy_value');
            $table->double('carbohydrates');
            $table->double('sugars')->nullable();
            $table->double('proteins')->nullable();
            $table->double('fats')->nullable();
            $table->double('dietary_fiber')->nullable();
            $table->double('sodium')->nullable();
            $table->double('other_value')->nullable();
            $table->string('other_type', 30)->nullable();
            $table->timestamps();
        });

        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('group_type', 250);
        });

        Schema::create('food_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('food_id')
            ->references('id')
            ->on('foods')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->foreignId('group_id')
            ->references('id')
            ->on('groups')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
        });

        Schema::create('user_foods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('food_id')
            ->references('id')
            ->on('foods')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->foreignId('user_id')
            ->references('id')
            ->on('users')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
        });

        DB::table('groups')->insert([
            ['group_type' => 'PÃES E CERAIS'],
            ['group_type' => 'LEITE E DERIVADOS'],
            ['group_type' => 'FRUTAS'],
            ['group_type' => 'VEGETAIS A'],
            ['group_type' => 'VEGETAIS B'],
            ['group_type' => 'CARNES'],
            [ 'group_type' => 'ARROZ, MASSAS, TUBÉRCULOS'],
            ['group_type' => 'LEGUMINOSAS'],
            ['group_type' => 'CASTANHAS, SEMENTES'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_foods');
        Schema::dropIfExists('food_groups');
        Schema::dropIfExists('groups');
        Schema::dropIfExists('foods');
    }
}
