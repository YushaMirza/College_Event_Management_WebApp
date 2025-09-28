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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->enum('category', ['Technical','Cultural', 'Meetup',  'Sport', 'Workshop','Seminar', 'Conference', 'Competition', 'all']);
            $table->string('venue');
            $table->enum('media_type', ['image', 'video']);
            $table->string('media_file');
            $table->string('caption');
            $table->string('organizer_id');
            $table->boolean('is_open')->default(true);
            $table->dateTime('start');
            $table->dateTime('end');
            $table->dateTime('registration_deadline')->nullable();
            $table->integer('slots_fulled');
            $table->integer('max_slots')->default(100);
            $table->string('eligible_years')->nullable();
            $table->timestamps();

            $table->foreign('organizer_id')
                ->references('enrollment_id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
