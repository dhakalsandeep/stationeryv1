<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',100);
            $table->string('address',100)->nullable();
            $table->string('phoneno',20)->nullable();
            $table->string('email',100)->nullable();
            $table->integer('users_id');
            $table->integer('company_infos_id');
            $table->timestamps();

            $table->index('users_id');
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
        Schema::dropIfExists('suppliers');
    }
}
