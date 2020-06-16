<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relawan extends Model
{
	protected $table = 'table_relawan';
	protected $guarded = ['id'];

	public function komunitas()
	{
		return $this->belongsTo('App\Komunitas', 'komunitas_id');
	}

	public function user()
	{
		return $this->belongsTo('App\User', 'user_id');
	}
}
