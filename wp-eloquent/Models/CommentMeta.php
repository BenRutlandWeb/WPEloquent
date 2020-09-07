<?php

namespace WPEloquent\Models;

use WPEloquent\Models\Comment;
use Illuminate\Database\Eloquent\Model;

class CommentMeta extends Model
{
	public $timestamps = false;
	
	protected $table = 'commentmeta';
	
	protected $primaryKey = 'meta_id';
	
	protected $fillable = [
		'meta_key', 
		'meta_value',
	];
	
	// relationships
	
	public function comment()
	{
		return $this->belongsTo(Comment::class, 'comment_id', 'comment_ID');
	}
}