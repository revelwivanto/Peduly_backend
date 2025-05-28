<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->double('price', 8, 2);
            $table->boolean('featured')->default(false);
            $table->enum('activity_type', ['adventure', 'cultural', 'sightseeing', 'food', 'relaxation', 'other', 'outdoor']);
            $table->enum('difficulty_level', ['easy', 'moderate', 'challenging', 'difficult']);
            $table->string('image')->nullable();
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('duration'); // Duration in minutes
            $table->integer('max_participants')->nullable();
            $table->integer('min_participants')->default(1);
            $table->string('city');
            $table->string('city_slug');
            $table->string('meeting_point');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('description');
            $table->text('included_items')->nullable();
            $table->text('excluded_items')->nullable();
            $table->text('cancellation_policy')->nullable();
            $table->string('video')->nullable();
            $table->string('location_latitude');
            $table->string('location_longitude');
            $table->text('nearby')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
