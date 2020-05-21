<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code',10);
            $table->string('name',100);
            $table->string('isbn',20);
            $table->string('print_date',20);
            $table->string('revised_date',20);
            $table->string('author',100);
            $table->integer('publishers_id');
            $table->integer('items_types_id');
            $table->integer('users_id');
            $table->integer('company_infos_id');
            $table->integer('modify_by_id')->default(0);
            $table->timestamps();

            $table->index('items_types_id');
            $table->index('publishers_id');
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
        Schema::dropIfExists('items');
    }
}
