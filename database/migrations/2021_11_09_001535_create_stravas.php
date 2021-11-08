<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('stravas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->onUpdate('cascade')->onDelete('cascade');
            $table->string('profile_url');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stravas');
    }
};
