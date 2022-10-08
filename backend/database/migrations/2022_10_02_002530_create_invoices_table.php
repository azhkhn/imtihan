<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->float('price');
            $table->date('start_date');
            $table->date('end_date');
            $table->float('discount')->nullable();
            $table->float('total');
            $table->dateTime('paid_at')->nullable();
            $table->foreignId('payment_coupon_id')->nullable()->index();
            $table->foreignId('company_id')->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};
