<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('aduans', function (Blueprint $table) {
            $table->uuid('id')->primary(); // UUID sebagai primary key
            $table->string('nama_lengkap');
            $table->string('nomor_hp', 20);
            $table->text('alamat');
            $table->text('isi_aduan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aduans');
    }
};
