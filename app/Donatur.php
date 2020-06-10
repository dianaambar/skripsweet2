<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donatur extends Model
{
    protected $table = 'table_donatur';
	protected $guarded = ['id'];

    public function user(){
		return $this->belongsTo('App\User', 'user_id');
	}
}
