<?php

namespace WPEloquent\Models;

use WPEloquent\Models\Taxonomy;
use WPEloquent\Models\TermRelationship;
use WPEloquent\Models\Post;
use WPEloquent\Models\TermMeta;
use WPEloquent\Traits\HasMeta;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
	use HasMeta;
	use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
	
	public $timestamps = false;
	
	protected $table = 'terms';
	
	protected $primaryKey = 'term_id';
	
	// relationships
	
	public function meta()
	{
		return $this->hasMany(TermMeta::class, 'term_id', 'term_id');
	}
	
	public function taxonomy()
	{
		return $this->belongsTo(Taxonomy::class, 'term_id', 'term_id');
	}	
	
	public function posts()
	{
		return $this->hasManyDeep(
			Post::class,
			[Taxonomy::class, TermRelationship::class],
			['term_taxonomy_id', 'term_taxonomy_id', 'ID'],
			['term_id', 'term_id', 'object_id']
		);
		return $this->hasMany(Post::class, 'term_id', 'term_id');
	}
}