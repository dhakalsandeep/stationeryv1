<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssueDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('items_id');
            $table->integer('purchase_details_id');
            $table->string('issue_date',10);
            $table->string('issue_date_ad',10);
            $table->string('issue_time',10);
            $table->integer('ids_id'); //IssueDetailsID
            $table->integer('from_dep_id');
            $table->integer('to_dep_id');
            $table->integer('qty');
            $table->integer('cur_qty');
            $table->string('fiscal_year',6);
            $table->string('transaction_type',20);
            $table->string('edition');
            $table->integer('users_id');
            $table->integer('company_infos_id');
            $table->timestamps();

            $table->index('purchase_details_id');
            $table->index('ids_id');
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
        Schema::dropIfExists('issue_details');
    }
}
