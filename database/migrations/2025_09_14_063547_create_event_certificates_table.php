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
        Schema::create('event_certificates', function (Blueprint $table) {
            $table->id(); // id column
            $table->unsignedBigInteger('event_id'); // event_id
            $table->string('file_path')->nullable(); // file_path
            $table->timestamp('issued_at')->nullable(); // issued_at
            $table->timestamps(); // created_at & updated_at

            // Foreign keys
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_certificates');
    }
};
