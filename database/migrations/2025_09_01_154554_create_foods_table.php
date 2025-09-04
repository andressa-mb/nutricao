<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->string('measure_type', 10);
            $table->double('energy_value');
            $table->double('carbohydrates');
            $table->double('sugars')->nullable();
            $table->double('proteins')->nullable();
            $table->double('fats')->nullable();
            $table->double('dietary_fiber')->nullable();
            $table->double('sodium')->nullable();
            $table->double('other')->nullable();
            $table->timestamps();
        });

        Schema::create('food_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('food_id')
            ->references('id')
            ->on('foods')
            ->onDelete('restrict')
            ->cascadeOnUpdate();
            $table->enum('group', [1, 2, 3, 4, 5, 6, 7, 8, 9]);
            $table->enum('food_type', ['PÃES E CERAIS', 'LEITE E DERIVADOS', 'FRUTAS', 'VEGETAIS A', 'VEGETAIS B', 'CARNES', 'ARROZ, MASSAS, TUBÉRCULOS', 'LEGUMINOSAS', 'CASTANHAS, SEMENTES']);
        });

        Schema::create('user_foods', function (Blueprint $table) {
            $table->foreignId('food_id')
            ->references('id')
            ->on('foods')
            ->onDelete('restrict')
            ->cascadeOnUpdate();
            $table->foreignId('user_id')
            ->references('id')
            ->on('users')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_foods');
        Schema::dropIfExists('food_types');
        Schema::dropIfExists('foods');
    }
}
