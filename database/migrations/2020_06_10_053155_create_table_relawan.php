<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRelawan extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('table_relawan', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('user_id');
			$table->integer('komunitas_id');
			$table->string('nama_panggilan');
			$table->string('jenis_kelamin');
			$table->string('agama');
			$table->string('gol_darah');
			$table->string('kabupaten_kota');
			$table->string('provinsi');
			$table->string('tempat_lahir');
			$table->date('tgl_lahir');
			$table->string('pekerjaan');
			//$table->string('media_sosial');
			$table->string('pend_terakhir');
			$table->string('organisasi_ongoing');
			$table->string('jenis_sim');
			$table->text('foto_relawan');
			$table->string('motivasi');
			$table->string('latitude')->nullable();
			$table->string('longitude')->nullable();
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
		Schema::dropIfExists('table_relawan');
	}
}
