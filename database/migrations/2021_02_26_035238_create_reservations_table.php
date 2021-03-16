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
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->decimal('amount', 18, 2);
            $table->integer('guest_no');
            $table->boolean('is_paid')->default(0);
            $table->string('deposit_img')->nullable();
            $table->string('bank')->nullable();
            $table->dateTime('time_deposited')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('contact_no');
            $table->text('requests');
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
