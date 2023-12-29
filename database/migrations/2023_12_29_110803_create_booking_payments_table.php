<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_payments', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->nullable();
            $table->string('transaction_reference_number')->nullable();
            $table->string('date_time')->nullable();
            $table->string('payment_gateway')->nullable();
            $table->string('status_code')->nullable();
            $table->text('comment')->nullable();
            $table->foreignId('booking_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('booking_payments');
    }
}
