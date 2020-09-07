<?php

namespace WPEloquent\Models;

use Illuminate\Database\Eloquent\Model;
use WPEloquent\Models\Comment;
use WPEloquent\Models\Post;
use WPEloquent\Models\UserMeta;
use WPEloquent\Traits\HasMeta;

class User extends Model
{
	use HasMeta;

	/**
	 * The name of the "created at" column.
	 *
	 * @var string
	 */
	const CREATED_AT = 'user_registered';

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The primary key for the model.
	 *
	 * @var string
	 */
	protected $primaryKey = 'ID';

	/**
	 * Get the User email address.
	 */
	public function getEmailAttribute()
	{
		return $this->user_email;
	}

	/**
	 * Get the User created at date.
	 */
	public function getCreatedAtAttribute()
	{
		return $this->user_registered;
	}

	/**
	 * Get the User posts.
	 */
	public function posts()
	{
		return $this->hasMany(Post::class, 'post_author', 'ID');
	}

	/**
	 * Get the User comments.
	 */
	public function comments()
	{
		return $this->hasMany(Comment::class, 'user_id', 'ID');
	}

	/**
	 * Get the User meta.
	 */
	public function meta()
	{
		return $this->hasMany(UserMeta::class, 'user_id', 'ID');
	}
}
