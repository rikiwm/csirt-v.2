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
        Schema::create('menus', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('name');
            $table->string('icon')->nullable();
            $table->string('slug')->nullable();
            $table->integer('order')->default(0);
            $table->foreignId('parent_id')->index()->nullable()->constrained('menus')->onDelete('cascade');
            $table->boolean('is_active')->default(true);
            $table->enum('type', ['place','page', 'list','link'])->default('place');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
