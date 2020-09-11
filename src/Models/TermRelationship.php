<?php

namespace WPEloquent\Models;

use Illuminate\Database\Eloquent\Model;

class TermRelationship extends Model
{
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
    protected $table = 'term_relationships';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'term_taxonomy_id';
}
