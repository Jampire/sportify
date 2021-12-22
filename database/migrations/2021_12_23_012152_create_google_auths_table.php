<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    // TODO: no need?
    public function up()
    {
        Schema::create('google_auths', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')
                ->unique()
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('google_id')->unique();
            $table->string('token');
            $table->string('refresh_token');
            $table->dateTime('expires_in');
            $table->string('nickname')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('avatar')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('google_auths');
    }
};
