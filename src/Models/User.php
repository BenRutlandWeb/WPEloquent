<?php

namespace WPEloquent\Models;

use WPEloquent\Models\Comment;
use WPEloquent\Models\Post;
use WPEloquent\Models\UserMeta;
use WPEloquent\Traits\HasMeta;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	use HasMeta;
	
	const CREATED_AT = 'user_registered';
	
	public $timestamps = false;
	
	protected $table = 'users';
	
	protected $primaryKey = 'ID';
	
	// aliases
	
	public function getEmailAttribute()
	{
		return $this->user_email;
	}	
	
	public function getCreatedAtAttribute()
	{
		return $this->user_registered;
	}
	
	// relationships
	
	public function posts()
	{
		return $this->hasMany(Post::class, 'post_author', 'ID');
	}
	
	public function comments()
	{
		return $this->hasMany(Comment::class, 'user_id', 'ID');
	}
	
	public function meta()
	{
		return $this->hasMany(UserMeta::class, 'user_id', 'ID');
	}
}