<?php

namespace WPEloquent\Models;

use WPEloquent\Models\Term;
use Illuminate\Database\Eloquent\Model;

class TermMeta extends Model
{	
	public $timestamps = false;
	
	protected $table = 'termmeta';
	
	protected $primaryKey = 'meta_id';
	
	protected $fillable = [
		'meta_key', 
		'meta_value',
	];
	
	// relationships
	
	public function term()
	{
		return $this->belongsTo(Term::class, 'term_id', 'term_id');
	}
}