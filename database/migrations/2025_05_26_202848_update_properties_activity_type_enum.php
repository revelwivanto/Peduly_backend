<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            // First, modify the column to be a string temporarily
            $table->string('activity_type')->change();
        });

        // Then update the column back to enum with new values
        DB::statement("ALTER TABLE properties MODIFY COLUMN activity_type ENUM('adventure', 'cultural', 'sightseeing', 'food', 'relaxation', 'other', 'outdoor', 'Masak', 'Workshop')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            // First, modify the column to be a string temporarily
            $table->string('activity_type')->change();
        });

        // Then update the column back to original enum values
        DB::statement("ALTER TABLE properties MODIFY COLUMN activity_type ENUM('adventure', 'cultural', 'sightseeing', 'food', 'relaxation', 'other', 'outdoor')");
    }
};
