<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDonasi extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('table_donasi', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('komunitas_id');
			$table->integer('donatur_id');
			$table->integer('relawan_id')->nullable();
			$table->integer('penerima_id')->nullable();
			$table->string('alamat_penjemputan');
			$table->dateTime('tgl_penjemputan');
			$table->time('waktu_penjemputan');
			$table->string('status');
			$table->decimal('latitude');
			$table->decimal('longitude');
			$table->text('notes')->nullable();
			$table->text('foto')->nullable();
			$table->boolean('accDonasi')->default(false);
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
		Schema::dropIfExists('table_donasi');
	}
}
