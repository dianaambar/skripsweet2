<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableKomunitas extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('table_komunitas', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('user_id');
			$table->date('tgl_berdiri');
			$table->text('legalitas');
			$table->text('foto_komunitas');
			//$table->boolean('status')->default(false);
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
		Schema::dropIfExists('table_komunitas');
	}
}
