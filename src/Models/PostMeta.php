<?php

namespace WPEloquent\Models;

use WPEloquent\Models\Post;
use Illuminate\Database\Eloquent\Model;

class PostMeta extends Model
{
	public $timestamps = false;
	
	protected $table = 'postmeta';
	
	protected $primaryKey = 'meta_id';
	
	protected $fillable = [
		'meta_key', 
		'meta_value',
	];
	
	// relationships
	
	public function post()
	{
		return $this->belongsTo(Post::class, 'post_id', 'ID');
	}
}