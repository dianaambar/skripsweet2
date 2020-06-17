<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MakananDonasi extends Model
{
	protected $table = "table_makanan_donasi";
	protected $guarded = ['id'];

	public function makanan()
	{
		return $this->belongsTo('App\Makanan', 'makanan_id');
	}
}
