<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsRoomRacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_room_racks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('items_managements_id');
            $table->string('room_no',3);
            $table->string('rack_no',10);
            $table->integer('qty');
            $table->integer('users_id');
            $table->integer('company_infos_id');
            $table->timestamps();

            $table->index('items_managements_id');
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
        Schema::dropIfExists('items_room_racks');
    }
}
