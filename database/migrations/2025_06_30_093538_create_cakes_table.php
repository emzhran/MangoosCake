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
        Schema::create('cakes', function (Blueprint $table) {
            $table->id(); 
            $table->string('nama_kue'); 
            $table->decimal('harga_kue', 10, 2); 
            $table->binary('gambar_kue')->nullable(); 
            $table->timestamps(); 
        });
    }

    /**
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cakes');
    }
};