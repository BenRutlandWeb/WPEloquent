<?php

namespace WPEloquent\Models;

use WPEloquent\Models\Term;
use Illuminate\Database\Eloquent\Model;

class Taxonomy extends Model
{
    public $timestamps = false;

    protected $table = 'term_taxonomy';

    protected $primaryKey = 'term_taxonomy_id';

    // aliases

    public function getNameAttribute()
    {
        return $this->taxonomy;
    }

    // scopes

    public function scopeCategory($query)
    {
        return $query->where('taxonomy', '=', 'category');
    }

    public function scopeTag($query)
    {
        return $query->where('taxonomy', '=', 'post_tag');
    }

    // relationships

    public function terms()
    {
        return $this->hasMany(Term::class, 'term_id', 'term_id');
    }
}
