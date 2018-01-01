<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('firstname',45);
            $table->string('lastname',45);
            $table->string('email',100)->unique();
            $table->string('designation');
            $table->string('password',200);
            $table->rememberToken();
            $table->string('mobile_no',20);
            $table->integer('user_type')->default(0);
            $table->string('photo',100)->nullable();
            $table->text('address')->nullable();
            $table->boolean('verify')->default(0);
            $table->string('token')->nullable();
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
