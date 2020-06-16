<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Makanan extends Model
{
	protected $table = "table_makanan";
	protected $guarded = ['id'];

	public function jenisMakanan()
	{
		return $this->belongsTo('App\JenisMakanan', 'jenis_makanan_id');
	}
}
