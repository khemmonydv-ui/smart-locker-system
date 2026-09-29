<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();

            // The locker that has the problem.
            // If the locker is deleted, its reports are deleted too.
            $table->foreignId('locker_id')
                ->constrained('lockers')
                ->cascadeOnDelete();

            // The user who REPORTED the problem.
            // IMPORTANT: nullOnDelete keeps the report if the user is deleted,
            // so the maintenance history is never lost. That is why it is nullable.
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // The staff member who is FIXING it (shown in the "Assigned" column).
            // Null = nobody assigned yet.
            $table->foreignId('assigned_to')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // What happened, written by the person reporting.
            $table->text('problem');

            // pending -> in_progress -> resolved
            $table->string('status')->default('pending');

            // Urgent reports show a warning icon and are sorted to the top.
            $table->boolean('is_urgent')->default(false);

            // When the problem was reported / when it was fixed.
            $table->timestamp('reported_at')->useCurrent();
            $table->timestamp('resolved_at')->nullable();

            $table->timestamps();

            // The page filters and sorts by these two columns, so an index keeps it fast.
            $table->index(['status', 'is_urgent']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};