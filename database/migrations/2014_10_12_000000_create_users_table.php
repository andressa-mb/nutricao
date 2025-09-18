<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->date('birthday');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('role_name', 20);
        });

        Schema::create('user_roles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
            ->references('id')
            ->on('users')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->foreignId('role_id')
            ->references('id')
            ->on('roles')
            ->onDelete('restrict')
            ->cascadeOnUpdate();
        });


        DB::table('roles')->insert([
            ['id' => 1, 'role_name' => 'ADMIN'],
            ['id' => 2, 'role_name' => 'STANDARD'],
        ]);

        DB::table('users')->insert([
            ['id' => 1, 'name' => 'Andressa', 'email' => 'andressa@email.com', 'birthday' => '1993-08-26', 'password' => Hash::make('12345678'), "created_at" => "2025-09-10",
            "updated_at" => "2025-09-10"]
        ]);

        DB::table('user_roles')->insert([
            ['user_id' => 1, 'role_id' => 1]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_roles');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('users');
    }
}
