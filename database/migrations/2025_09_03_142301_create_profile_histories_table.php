<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')
            ->references('id')
            ->on('profiles')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->double('weight_prev');
            $table->double('goal_prev');
            $table->double('metabolism_prev')->nullable();
            $table->date('recorded_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_histories');
    }
}
