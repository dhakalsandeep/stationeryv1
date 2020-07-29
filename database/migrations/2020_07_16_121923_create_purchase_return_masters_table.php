<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseReturnMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_return_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('purchase_master_id')->unsigned();
            $table->string('return_date',10);
            $table->string('return_date_ad',10);
            $table->string('return_no',20);
            $table->string('return_by',100);
            $table->string('fiscal_year',6);
            $table->float('amount');
            $table->float('discount');
            $table->float('dis_per');
            $table->float('vat');
            $table->float('total_amount');
            $table->integer('users_id');
            $table->integer('company_infos_id');
            $table->integer('status')->default(1);
            $table->timestamps();
        });

        Schema::table('purchase_return_masters', function (Blueprint $table) {
            $table->foreign('purchase_master_id')->references('id')->on('purchase_masters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_return_masters');
    }
}
