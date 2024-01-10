<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->string('f_name',50);
            $table->string('l_name',50);
            $table->string('default_password',50)->nullable();
            $table->string('email',80)->unique();
            $table->string('username',20)->unique();
            $table->enum('type', ['ADMIN', 'USERS']);
            $table->integer('status');
            $table->integer('admin_id');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 100);
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
