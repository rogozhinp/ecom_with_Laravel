<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->date('data');
            $table->text('status');
            $table->date('del date');
            $table->decimal('price', 8, 2);
            $table->text('first_name');
            $table->text('address');
            $table->char('last_name' , 50);
            $table->integer('phone');
            $table->integer('zip');
            $table->char('email', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
