<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('model_type', ['CUSTOMER']);
            $table->integer('model_id');
            $table->double('credit_amount', 11,2)->nullable();
            $table->double('debit_amount', 11,2)->nullable();
            $table->enum('transiction_type', ['CREDIT', 'DEBIT']);
            $table->string('transaction_description')->nullable();
            $table->integer('user_id');
            $table->integer('admin_id');
            $table->integer('decleration_date_id');
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
        Schema::dropIfExists('transactions');
    }
}
