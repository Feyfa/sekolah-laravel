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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id')->unique();
            $table->string('foto')->nullable();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('password');
            $table->enum('jenis_kelamin', ['Laki-Laki','Perempuan'])->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->integer('umur')->nullable();
            $table->integer('tinggi')->nullable();
            $table->integer('berat')->nullable();
            $table->string('nohp')->nullable();
            $table->text('alamat')->nullable();
            $table->text('pendidikan')->nullable();
            $table->text('hobi')->nullable();
            $table->text('motivasi')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
