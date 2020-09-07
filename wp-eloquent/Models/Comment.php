<?php

namespace WPEloquent\Models;

use WPEloquent\Traits\HasMeta;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	use HasMeta;
	
	const CREATED_AT = 'comment_date';
	
	public $timestamps = false;
	
	protected $table = 'comments';
	
	protected $primaryKey = 'comment_ID';
	
	// aliases
	
	public function getContentAttribute()
	{
		return $this->comment_content;
	}
	
	public function getCreatedAtAttribute()
	{
		return $this->comment_date;
	}
	
	// relationships
	
	public function post()
	{
		return $this->belongsTo(Post::class, 'comment_post_ID', 'ID');
	}
	
	public function meta()
	{
		return $this->hasMany(CommentMeta::class, 'comment_id', 'comment_ID');
	}
	
	public function author()
	{
		return $this->belongsTo(User::class, 'user_id', 'ID');
	}
}