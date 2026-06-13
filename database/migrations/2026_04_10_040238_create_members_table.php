<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('members', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('asal_alamat');
        $table->string('tempat');
        $table->date('tanggal_lahir');
        $table->text('alamat');
        $table->string('no_hp');
        $table->string('email');
        $table->string('sosmed')->nullable();
        $table->string('instansi')->nullable();
        $table->text('alamat_instansi')->nullable();

        $table->string('foto')->nullable();

        $table->string('status')->default('pending'); // pending, validasi, selesai

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
