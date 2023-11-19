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
        foreach (Schema::getAllTables() as $table){
            Schema::table($table->Tables_in_final_project , function (Blueprint $blueprint){
                $blueprint->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach (Schema::getAllTables() as $table){
            Schema::table($table , function (Blueprint $blueprint){
                $blueprint->dropSoftDeletes();
            });
        }
    }
};

