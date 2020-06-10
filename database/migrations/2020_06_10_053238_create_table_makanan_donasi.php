<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMakananDonasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_makanan_donasi', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('makanan_id');
			$table->integer('donasi_id');
			$table->integer('jumlah');
			$table->string('unit');
			$table->dateTime('tgl_kadaluwarsa');
			$table->dateTime('tgl_produksi');
			$table->boolean('jamur');
			$table->boolean('bau');
			$table->boolean('berwarna');
			$table->boolean('berubahrasa');
			$table->boolean('berubahtesktur');
			$table->text('notes');
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
        Schema::dropIfExists('table_makanan_donasi');
    }
}
