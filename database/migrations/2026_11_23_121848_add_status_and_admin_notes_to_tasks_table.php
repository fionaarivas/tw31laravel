<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Add a workflow status (pending, in_progress, completed) and optional
     * admin notes to tasks. The legacy `completed` boolean is kept and
     * backfilled into the new status column.
     */
    public function up(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->string('status')
                ->default('pending')
                ->after('description')
                ->index();

            $table->text('admin_notes')
                ->nullable()
                ->after('status');
        });

        DB::table('tasks')
            ->where('completed', true)
            ->update(['status' => 'completed']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropColumn(['status', 'admin_notes']);
        });
    }
};
