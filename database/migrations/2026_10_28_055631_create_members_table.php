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
        Schema::create('members', function (Blueprint $table) {
             $table->id();

             $table->string('membership_number')->unique();
             $table->string('name');
             $table->string('email')->unique();
             $table->string('phone_number');
             $table->text('address');

             $table->foreignId('membership_category_id')
                ->constrained('membership_categories')
                ->restrictOnDelete();

             $table->foreignId('membership_level_id')
               ->constrained('membership_levels')
               ->restrictOnDelete();

             $table->string('status')->default('active');

             $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
