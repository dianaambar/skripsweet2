<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePenerimaDonasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_penerima_donasi', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('nama_penerima');
			$table->string('alamat_penerima');
			$table->text('foto');
			$table->string('latitude');
			$table->string('longitude');
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
        Schema::dropIfExists('table_penerima_donasi');
    }
}
