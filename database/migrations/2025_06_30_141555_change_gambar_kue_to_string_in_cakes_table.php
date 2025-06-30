<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cakes', function (Blueprint $table) {
            // Mengubah tipe kolom gambar_kue menjadi string
            $table->string('gambar_kue')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cakes', function (Blueprint $table) {
            // Jika migrasi di-rollback, kembalikan ke tipe binary
            $table->binary('gambar_kue')->nullable()->change();
        });
    }
};
