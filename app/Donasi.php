<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Donasi extends Model
{
	protected $table = "table_donasi";
	protected $guarded = ['id'];

	public function makananDonasi()
	{
		return $this->hasMany('App\MakananDonasi', 'donasi_id');
	}

	public function relawan()
	{
		return $this->belongsTo('App\Relawan', 'relawan_id');
	}

	public function komunitas()
	{
		return $this->belongsTo('App\Komunitas', 'komunitas_id');
	}

	//public function donatur()
	//{
	//	return $this->belongsTo('App\Donatur', 'donatur_id');
	//}

	public function penerimaDonasi()
	{
		return $this->belongsTo('App\PenerimaDonasi', 'penerima_id');
	}

	public function m()
	{
		return $this->makananDonasi()->first();
	}
}
