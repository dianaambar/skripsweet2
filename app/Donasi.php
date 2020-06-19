<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

	public function m()
	{
		return $this->makananDonasi()->first();
	}
}
