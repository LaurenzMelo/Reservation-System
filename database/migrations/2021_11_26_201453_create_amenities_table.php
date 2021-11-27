<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmenitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amenities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reservation_id');
            $table->boolean('bed_1')->default(0);
            $table->boolean('bed_2')->default(0);
            $table->boolean('person_1')->default(0);
            $table->boolean('person_2')->default(0);
            $table->boolean('common_kitchen')->default(0);
            $table->boolean('karaoke')->default(0);
            $table->decimal('amount', 18, 2);
            $table->timestamps();

            $table->foreign('reservation_id')->references('id')->on('reservations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amenities');
    }
}
