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
        Schema::table('users', function (Blueprint $table) {
            $table->text('dietary_preferences')->nullable()->after('password'); // Add dietary preferences
            $table->text('allergies')->nullable()->after('dietary_preferences'); // Add allergies
            $table->string('delivery_address')->nullable()->after('allergies'); // Add delivery address
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['dietary_preferences', 'allergies', 'delivery_address']); // Remove the columns
        });
    }
};
