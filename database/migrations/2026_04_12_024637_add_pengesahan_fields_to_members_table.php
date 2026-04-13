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
        Schema::table('members', function (Blueprint $table) {
            $table->string('pengesahan_nama')->nullable();
            $table->string('pengesahan_jabatan')->nullable();
            $table->string('pengesahan_no_hp')->nullable();
            $table->boolean('pengesahan_kenal')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn(['pengesahan_nama', 'pengesahan_jabatan', 'pengesahan_no_hp', 'pengesahan_kenal']);
        });
    }
};
