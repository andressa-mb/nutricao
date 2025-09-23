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
            $table->timestamp('birthday');
            $table->char('sex', 1);
            $table->string('password');
            $table->rememberToken();
            $table->timestamps(); //cria pela model
            /*
              CRIA MANUALMENTE MAS SE TROCAR DE BANCO PODE NÃO HAVER ESSA FUNÇÃO
              $table->timestamp('created_at', 0)->nullable()->default(DB::raw('NOW()'));
              $table->timestamp('updated_at', 0)->nullable()->default(DB::raw('NOW()'));
            */
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
            ['role_name' => 'ADMIN'],
            ['role_name' => 'STANDARD'],
        ]);

        DB::table('users')->insert([
            ['name' => 'Andressa', 'email' => 'andressa@email.com', 'birthday' => '1993-08-26', 'sex' => 'F', 'password' => Hash::make('12345678'), "created_at" => now()->subDays(5)->format('Y-m-d'), "updated_at" => now()->subDays(5)->format('Y-m-d')]
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
