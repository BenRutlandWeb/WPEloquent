<?php

namespace WPEloquent\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
	public $timestamps = false;
	
	protected $table = 'options';
	
	protected $primaryKey = 'option_id';
	
	protected $fillable = [
		'option_name', 
		'option_value',
	];
}