<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublishersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publishers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',100);
            $table->string('country',50);
            $table->string('address',100);
            $table->string('url');
            $table->integer('user_id');
            $table->integer('company_infos_id');
            $table->integer('modify_by_id')->default(0);
            $table->timestamps();

            $table->index('user_id');
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
        Schema::dropIfExists('publishers');
    }
}
