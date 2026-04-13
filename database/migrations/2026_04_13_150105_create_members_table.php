<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id(); // Ini ID unik bawaan Laravel (jangan dihapus)

            // Tambahkan baris di bawah ini:
            $table->string('nama_lengkap');
            $table->string('no_whatsapp'); // Wajib untuk fitur redirect WA nanti
            $table->integer('umur')->nullable(); // nullable berarti boleh dikosongkan
            $table->string('sabuk')->nullable();
            $table->enum('status', ['calon', 'aktif'])->default('calon'); // Kunci utamanya di sini!

            $table->timestamps(); // Ini otomatis mencatat kapan data dibuat (jangan dihapus)
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
