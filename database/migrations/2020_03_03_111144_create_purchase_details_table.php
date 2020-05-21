<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('purchase_masters_id');
            $table->string('purchase_no',25);
            $table->integer('items_id');
            $table->string('edition',100);
            $table->float('amount');
            $table->integer('qty');
            $table->float('discount');
            $table->float('dis_per');
            $table->float('vat');
            $table->float('total_amount');
            $table->integer('users_id');
            $table->integer('company_infos_id');
            $table->timestamps();

            $table->index('purchase_masters_id');
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
        Schema::dropIfExists('purchase_details');
    }
}
