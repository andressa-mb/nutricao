<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileEvolutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_evolutions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')
            ->references('id')
            ->on('profiles')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->double('weight_current');
            $table->double('metabolism_current')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_evolutions');
    }
}
