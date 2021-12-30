<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFieldInTbTahunAjaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_tahun_ajaran', function (Blueprint $table) {
            //
            $table->dropColumn('tahun_ajaran');
            $table->string('mulai', 4);
            $table->string('sampai', 4);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_tahun_ajaran', function (Blueprint $table) {
            //
        });
    }
}
