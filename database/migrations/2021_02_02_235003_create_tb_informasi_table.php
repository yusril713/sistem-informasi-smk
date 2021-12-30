<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbInformasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_informasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('tb_kategori_info')->onDelete('cascade');
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('cover');
            $table->longText('konten');
            $table->string('publisher')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_informasi');
    }
}
