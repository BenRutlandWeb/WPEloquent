<?php

namespace WPEloquent\Models;

use WPEloquent\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
	public $timestamps = false;
	
	protected $table = 'usermeta';
	
	protected $primaryKey = 'umeta_id';
	
	protected $fillable = [
		'meta_key', 
		'meta_value',
	];
	
	// relationships
	
	public function user()
	{
		return $this->belongsTo(User::class, 'user_id', 'ID');
	}
}