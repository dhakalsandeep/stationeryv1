<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_managements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('items_id');
            $table->string('edition',50);
            $table->integer('room_no')->nullable();
            $table->string('rack_no',10)->nullable();
            $table->integer('qty');
            $table->integer('cur_qty');
            $table->integer('purchase_details_id');
            $table->integer('users_id');
            $table->integer('company_infos_id');
            $table->integer('status')->default(1);
            $table->timestamps();

            $table->index('purchase_details_id');
            $table->index('company_infos_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items_managements');
    }
}
