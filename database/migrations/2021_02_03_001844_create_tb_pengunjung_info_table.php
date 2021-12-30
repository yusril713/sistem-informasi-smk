<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPengunjungInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pengunjung_info', function (Blueprint $table) {
            $table->id();
            $table->foreignId('info_id')->constrained('tb_informasi')->onDelete('cascade');
            $table->string('slug');
            $table->string('url');
            $table->string('ip');
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
        Schema::dropIfExists('tb_pengunjung_info');
    }
}
