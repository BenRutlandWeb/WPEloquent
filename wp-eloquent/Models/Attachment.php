<?php

namespace WPEloquent\Models;

use WPEloquent\Models\Post;

class Attachment extends Post
{
	public $postType = 'attachment';
	
	public function post()
	{
		return $this->belongsTo(Post::class, 'post_parent', 'ID');
	}
}