<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeclerationDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('decleration_dates', function (Blueprint $table) {
            $table->id();
            $table->integer('model_id');
            $table->integer('currency_id');
            $table->enum('model_type', ['CUSTOMER']);
            $table->integer('user_id');
            $table->integer('admin_id');
            $table->softDeletes();
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
        Schema::dropIfExists('decleration_dates');
    }
}
