<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('user_event', function (Blueprint $table) {
            $table->foreignId('user_id')->index()->constrained()->cascadeOnDelete();
            $table->foreignId('event_id')->index()->constrained()->cascadeOnDelete();
            $table->primary(['user_id', 'event_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_event');
    }
};
