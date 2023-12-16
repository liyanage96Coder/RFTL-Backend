<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->string('email');
            $table->string('full_name');
            $table->string('person_name')->nullable();
            $table->string('phone');
            $table->string('date_of_birth')->nullable();
            $table->double('donation');
            $table->foreignId('t_shirt_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('status');
            $table->string('payment_type');
            $table->boolean('is_group')->default(false);
            $table->string('group_category')->nullable();
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
        Schema::dropIfExists('bookings');
    }
}
