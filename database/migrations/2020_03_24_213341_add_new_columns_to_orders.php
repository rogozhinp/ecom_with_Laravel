<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnsToOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
            Schema::table('orders', function (Blueprint $table) {
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
        //
    }
}
