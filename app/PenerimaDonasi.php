<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenerimaDonasi extends Model
{
	protected $table = 'table_penerima_donasi';
	protected $guarded = ['id'];
}
