<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->nullable()->change();
            $table->string('socialite_id')->nullable()->after('profile_photo_path');
            $table->string('socialite_type')->nullable()->after('socialite_id')
                ->comment('Socialite driver used to authenticate the user');
            $table->string('socialite_token')->nullable()->after('socialite_type');
            $table->string('socialite_refresh_token')->nullable()->after('socialite_token');
            $table->dateTime('socialite_expires_in')->nullable()->after('socialite_refresh_token');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->change();
            $table->dropColumn('socialite_id');
            $table->dropColumn('socialite_type');
            $table->dropColumn('socialite_token');
            $table->dropColumn('socialite_refresh_token');
            $table->dropColumn('socialite_expires_in');
        });
    }
};
