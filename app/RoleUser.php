<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
	protected $table = "table_role_users";

	//buat bikin ga harus di fillable
	protected $guarded = ['id'];

	public function user()
	{
		return $this->belongsTo('App\User', 'user_id');
	}
}
