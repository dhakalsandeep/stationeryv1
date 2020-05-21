<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('supplier_bill_no',25);
            $table->string('purchase_no',25);
            $table->integer('suppliers_id');
            $table->string('supplier_bill_date',10);
            $table->string('received_date',10);
            $table->string('received_by',100);
            $table->string('fiscal_year',6);
            $table->float('amount');
            $table->float('discount');
            $table->float('dis_per');
            $table->float('vat');
            $table->float('total_amount');
            $table->integer('users_id');
            $table->integer('company_infos_id');
            $table->string('is_payment_done',1)->default('N');
            $table->timestamps();

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
        Schema::dropIfExists('purchase_masters');
    }
}
