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
			$table->string('jenis_kendaraan');
			$table->string('jenis_kelamin');
			$table->text('foto_relawan');
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
		Schema::dropIfExists('table_relawan');
	}
}
