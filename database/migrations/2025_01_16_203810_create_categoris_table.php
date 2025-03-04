<?php

use Illuminate\Container\Attributes\Auth;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categoris', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('name');
            $table->string('slug');
            $table->string('icon')->nullable();
            $table->text('description');
            $table->boolean('is_active')->default(true);
            $table->foreignId('parent_id')->index()->nullable()->constrained('categoris')->onDelete('cascade');
            $table->foreignId('created_by')->index()->default(FacadesAuth::user()->id ?? 1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categoris');
    }
};
