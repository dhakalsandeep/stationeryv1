<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseReturnDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_return_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('purchase_return_master_id')->unsigned();
            $table->unsignedBigInteger('purchase_detail_id')->unsigned();
            $table->string('return_no',25);
            $table->integer('items_id');
            $table->string('edition');
            $table->float('amount');
            $table->integer('return_qty');
            $table->float('discount');
            $table->float('dis_per');
            $table->float('vat');
            $table->float('total_amount');
            $table->integer('users_id');
            $table->integer('company_infos_id');
            $table->integer('status')->default(1);
            $table->timestamps();
        });

        Schema::table('purchase_return_details', function($table) {
            $table->foreign('purchase_return_master_id')->references('id')->on('purchase_return_masters');
            $table->foreign('purchase_detail_id')->references('id')->on('purchase_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_return_details');
    }
}
