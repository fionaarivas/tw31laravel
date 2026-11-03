<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('membership_transactions', function (Blueprint $table) {
            $table->id();

            $table->string('transaction_number')->unique();

            $table->foreignId('member_id')
                ->constrained('members')
                ->restrictOnDelete();

            $table->foreignId('membership_level_id')
                ->constrained('membership_levels')
                ->restrictOnDelete();

            $table->string('transaction_type');
            // application or renewal

            $table->decimal('amount', 10, 2);

            $table->string('status')->default('pending');
            // pending, paid, approved, expired, cancelled

            $table->date('transaction_date');

            $table->date('membership_start_date')->nullable();

            $table->date('membership_end_date')->nullable();

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('membership_transactions');
    }
};