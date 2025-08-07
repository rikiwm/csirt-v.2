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
        Schema::table('tickets', function (Blueprint $table) {
            $table->text('domain')->nullable()->after('subject')->comment('domain vuln');
            $table->longText('file_report_vuln')->nullable()->after('is_verified')->comment('report_file_vuln vuln');
             $table->longText('recomendation')->nullable()->after('is_verified')->comment('recomendation vuln');
             $table->boolean('is_duplicate')->nullable()->after('is_verified')->comment('is_duplicate vuln');
             $table->longText('duplicate_details')->nullable()->after('is_verified')->comment('duplicate_details vuln');
             $table->date('time_prosess_ticket')->nullable()->after('is_verified')->comment('time_prosess_ticket vuln');
             $table->date('time_close_ticket')->nullable()->after('is_verified')->comment('time_close_ticket vuln');
             $table->boolean('is_reward')->nullable()->after('is_verified')->comment('is_reward vuln');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('domain');
            $table->dropColumn('recomendation');
             $table->dropColumn('is_duplicate');
             $table->dropColumn('duplicate_details');
             $table->dropColumn('time_prosess_ticket');
             $table->dropColumn('time_close_ticket');
             $table->dropColumn('is_reward');
             $table->dropColumn('file_report_vuln');
        });
    }
};
