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
        Schema::create('penduduks', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); 
            $table->integer('umur'); 
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']); 
            $table->text('alamat')->nullable(); 
            $table->unsignedBigInteger('pemetaan_ispa_id'); 

            // Membuat foreign key dari tabel penduduk ke tabel pemetaanispa
            $table->foreign('pemetaan_ispa_id')->references('id')->on('pemetaan_ispas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduks');
    }
};