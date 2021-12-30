<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSomeField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_galeri', function (Blueprint $table) {
            $table->foreignId('user_id')->after('id')->nullable()->constrained('users')->onDelete('set null');
        });

        Schema::table('tb_informasi', function (Blueprint $table) {
            $table->foreignId('user_id')->after('id')->nullable()->constrained('users')->onDelete('set null');
        });

        Schema::table('tb_file', function (Blueprint $table) {
            $table->foreignId('user_id')->after('id')->nullable()->constrained('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
