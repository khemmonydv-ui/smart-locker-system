<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            // The setting name, for example "system_name".
            // IMPORTANT: unique() guarantees one row per setting, which is
            // what makes updateOrCreate() work correctly.
            $table->string('key')->unique();

            // The setting value. Text and nullable so it can hold anything,
            // including an empty value.
            $table->text('value')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};