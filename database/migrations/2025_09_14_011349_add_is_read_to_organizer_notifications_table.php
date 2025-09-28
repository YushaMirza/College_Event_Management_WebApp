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
        Schema::table('organizer_notifications', function (Blueprint $table) {
            $table->boolean('is_read')->default(false)->after('color');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('organizer_notifications', function (Blueprint $table) {
            $table->dropColumn('is_read');
        });
    }
};
