<?php

namespace WPEloquent\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TermRelationship extends Model
{	
	public $timestamps = false;
	
	protected $table = 'term_relationships';
	
	protected $primaryKey = 'term_taxonomy_id';
}