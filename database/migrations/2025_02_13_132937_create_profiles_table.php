<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id()->primary();
            $table->foreignId('users_id')->nullable()->index();
            $table->string('address')->nullable();
            $table->string('address_second')->nullable();
            $table->bigInteger('phone_number')->nullable()->unique()->index();
            $table->bigInteger('nik')->nullable()->unique()->index();
            $table->string('jobs')->nullable();
            $table->string('img_profile')->nullable();
            $table->string('device')->nullable()->comment('hp si user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
