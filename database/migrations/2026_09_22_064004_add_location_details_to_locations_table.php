<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('locations', function (Blueprint $table) {
        $table->decimal('distance_km', 5, 1)->default(0);
        $table->unsignedInteger('available_slots')->default(0);
        $table->boolean('is_open')->default(true);
    });
}

public function down(): void
{
    Schema::table('locations', function (Blueprint $table) {
        $table->dropColumn(['distance_km', 'available_slots', 'is_open']);
    });
}
};
