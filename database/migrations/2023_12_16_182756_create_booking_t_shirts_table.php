<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingTShirtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_t_shirts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('t_shirt_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->integer('quantity')->default(0);
            $table->boolean('active')->default(true);
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
        Schema::dropIfExists('booking_t_shirts');
    }
}
