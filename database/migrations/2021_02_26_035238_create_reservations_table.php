<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('reservation_no');
            $table->decimal('amount', 18, 2);
            $table->integer('guest_no');
            $table->boolean('is_paid')->default(0);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('contact_no');
            $table->text('requests')->nullable();
            $table->dateTime('time_arrival');
            $table->decimal('payment', 18, 2)->default(0);
            $table->boolean('is_active')->default(1);
            $table->boolean('is_checked_in')->default(0);
            $table->boolean('is_checked_out')->default(0);
            $table->dateTime('expiry_date');
            $table->string('created_by')->nullable();
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
        Schema::dropIfExists('reservations');
    }
}
