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
        Schema::create('akun', function (Blueprint $table) {
            $table->string('Id_Akun', 10)->primary();
            $table->string('Id_Tim', 20)->nullable();
            $table->string('Id_Korwil', 10)->nullable();
            $table->string('Id_Mahasiswa', 10)->nullable();
            $table->string('Nama_Akun', 50);
            $table->string('Password');
            $table->enum('role', ['mahasiswa', 'korwil', 'tim', 'dinas'])->default('mahasiswa');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akuns');
    }
};
