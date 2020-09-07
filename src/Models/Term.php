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

	public $timestamps = false;

	protected $table = 'terms';

	protected $primaryKey = 'term_id';

	// relationships

	public function meta()
	{
		return $this->hasMany(TermMeta::class, 'term_id', 'term_id');
	}
}
