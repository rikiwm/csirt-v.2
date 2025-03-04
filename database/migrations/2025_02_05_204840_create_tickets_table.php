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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id()->primary();
            $table->foreignId('users_id')->index()->nullable();
            $table->foreignId('agent_id')->index()->nullable()->comment('Assigned By Helper');
            $table->string('code')->nullable()->comment('Code Ticket auto generate');
            $table->string('subject')->nullable()->comment('Ticket Subject Name');
            $table->text('description')->nullable()->comment('Ticket Description');
            $table->text('reason')->nullable()->comment('Alasan tidak verif');
            $table->enum('status', ['open', 'in_progress', 'closed'])->default('open');
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('low');
            $table->boolean('is_verified')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
