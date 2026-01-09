<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pedoman_persyaratans', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('pedoman_administrasi_id');
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->string('download_url')->nullable();
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            $table->foreign('pedoman_administrasi_id')
                ->references('id')
                ->on('pedoman_administrasis')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedoman_persyaratans');
    }
};
