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
        Schema::table('events', function (Blueprint $table) {
            $table->enum('attended', ['yes', 'no'])->default('no')->after('eligible_years');

            $table->string('code')->nullable()->after('attended');

            $table->enum('can_cancel', ['yes', 'no'])->default('no')->after('code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['attended', 'code', 'can_cancel']);
        });
    }
};
