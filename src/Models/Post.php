<?php

namespace WPEloquent\Models;

use WPEloquent\Models\Attachment;
use WPEloquent\Models\Comment;
use WPEloquent\Models\PostMeta;
use WPEloquent\Models\Taxonomy;
use WPEloquent\Models\Term;
use WPEloquent\Models\TermRelationship;
use WPEloquent\Models\User;
use WPEloquent\Scopes\PostTypeScope;
use WPEloquent\Traits\HasMeta;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	use HasMeta;
	use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
	
	const CREATED_AT = 'post_date';
	
	const UPDATED_AT = 'post_modified';
	
	protected $table = 'posts';
	
	protected $primaryKey = 'ID';
	
	public $postType = 'post';
	
		
	protected static function boot()
	{
			parent::boot();
			
			static::addGlobalScope(new PostTypeScope);
	}
	
	// aliases
	
	public function getTitleAttribute()
	{
		return $this->post_title;
	}
	
	public function getContentAttribute()
	{
		return $this->post_content;
	}
	
	public function getStatusAttribute()
	{
		return $this->post_status;
	}	
	
	public function getTypeAttribute()
	{
		return $this->post_type;
	}
	
	public function getSlugAttribute()
	{
		return $this->post_name;
	}	
	
	public function getCreatedAtAttribute()
	{
		return $this->post_date;
	}
	
	public function getUpdatedAtAttribute()
	{
		return $this->post_modified;
	}
	
	// methods
	
	public function featuredImage($size = 'post-thumbnail', $attr = '')
	{
		return wp_get_attachment_image((int) $this->getMeta('_thumbnail_id'), $size, false, $attr);
	}
	
	// scopes
	
	public function scopePublished($query)
	{
		return $query->where('post_status' ,'=', 'publish');
	}
	
	// relationships
	
	public function author()
	{
		return $this->belongsTo(User::class, 'post_author', 'ID');
	}
	
	public function comments()
	{
		return $this->hasMany(Comment::class, 'comment_post_ID', 'ID');
	}
	
	public function meta()
	{
		return $this->hasMany(PostMeta::class, 'post_id', 'ID');
	}
	
	public function attachments()
	{
		return $this->hasMany(Attachment::class, 'post_parent', 'ID');
	}

	public function terms()
	{
		return $this->hasManyDeep(
			Term::class,
			[TermRelationship::class, Taxonomy::class],
			['object_id', 'term_id', 'term_id'],
			['ID', 'term_taxonomy_id', 'term_taxonomy_id']
		);
  }
	
	public function categories()
	{
		return $this->terms()->where('taxonomy', '=', 'category');
	}

	public function tags()
	{
		return $this->terms()->where('taxonomy', '=', 'post_tag');
	}

}