<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarbersTable extends Migration {
    public function up() {
        Schema::create('barbers', function (Blueprint $table) {
            $table->id();
            $table->string('barber_name', 255);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('barbers');
    }
}
