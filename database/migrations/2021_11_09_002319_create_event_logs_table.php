<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('event_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('event_id')->constrained();
            $table->foreignId('organization_id')->constrained();
            $table->string('track_url');
            $table->string('track_distance');
            $table->dateTime('track_start_date');
            $table->unsignedMediumInteger('track_duration');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('event_logs');
    }
};
