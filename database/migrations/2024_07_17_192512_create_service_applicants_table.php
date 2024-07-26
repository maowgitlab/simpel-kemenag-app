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
        Schema::create('service_applicants', function (Blueprint $table) {
            $table->id();
            $table->string('kode_layanan')->unique();
            $table->foreignId('list_id')->references('id')->on('list_services')->onDelete('cascade');
            $table->foreignId('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->string('nama');
            $table->string('email');  
            $table->string('pesan');
            $table->string('diproses_oleh')->nullable();
            $table->string('file_persyaratan')->nullable();
            $table->enum('status', ['pending', 'diproses', 'selesai'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_applicants');
    }
};
