<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('cake_id')->constrained()->onDelete('cascade');
            $table->date('tanggal_pemesanan'); 
            $table->integer('jumlah_pemesanan'); 
            $table->text('catatan')->nullable(); 
            $table->string('status')->default('pending'); 
            $table->timestamps(); 
        });
    }

    /**
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};