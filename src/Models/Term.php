<?php

namespace WPEloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use WPEloquent\Models\TermMeta;
use WPEloquent\Traits\HasMeta;

class Term extends Model
{
	use HasMeta;

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
	protected $table = 'terms';

	/**
	 * The primary key for the model.
	 *
	 * @var string
	 */
	protected $primaryKey = 'term_id';

	/**
	 * Get the User meta.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\Relation
	 */
	public function meta(): Relation
	{
		return $this->hasMany(TermMeta::class, 'term_id', 'term_id');
	}
}
