<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration {
    public function up() {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->foreignId('barber_id')->constrained('barbers')->onDelete('cascade');
            $table->dateTime('appointment');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('appointments');
    }
}
