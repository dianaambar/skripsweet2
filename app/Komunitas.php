<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komunitas extends Model
{
	protected $table = 'table_komunitas';
	protected $guarded = ['id'];

	public function relawan()
	{
		return $this->hasMany('App\Relawan', 'komunitas_id');
	}

	public function donasi()
	{
		return $this->hasMany('App\Donasi', 'komunitas_id');
	}

	public function user()
	{
		return $this->belongsTo('App\User', 'user_id');
	}
}
