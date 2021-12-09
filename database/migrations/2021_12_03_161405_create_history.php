<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id');
            $table->string('customer_name');
            $table->string('fecha');
            $table->string('store_number');
            $table->string('re');
            $table->string('sow');
            $table->decimal('sub_total',10, 2);
            $table->decimal('contract_fee',10, 2);
            $table->decimal('grand_total',10, 2);
            $table->string('job_status');
            $table->string('pay_status');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history');
    }
}
