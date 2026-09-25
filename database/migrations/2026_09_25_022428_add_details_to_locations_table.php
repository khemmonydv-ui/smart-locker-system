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
    Schema::table('locations', function (Blueprint $table) {
        $table->string('opening_hours')->nullable();
        $table->string('phone')->nullable();
        $table->text('description')->nullable();
    });
}

public function down(): void
{
    Schema::table('locations', function (Blueprint $table) {
        $table->dropColumn(['opening_hours', 'phone', 'description']);
    });
}
};
