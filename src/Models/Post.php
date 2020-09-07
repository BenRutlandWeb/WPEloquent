<?php

namespace WPEloquent\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use WPEloquent\Models\Attachment;
use WPEloquent\Models\Comment;
use WPEloquent\Models\PostMeta;
use WPEloquent\Models\Taxonomy;
use WPEloquent\Models\TermRelationship;
use WPEloquent\Models\User;
use WPEloquent\Scopes\PostTypeScope;
use WPEloquent\Traits\HasMeta;

class Post extends Model
{
    use HasMeta;

    /**
     * The name of the "created at" column.
     *
     * @var string
     */
    const CREATED_AT = 'post_date';

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = 'post_modified';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * The post type for the model.
     *
     * @var string
     */
    public $postType = 'post';

    /**
     * Bootstrap the model and its traits.
     *
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();

        static::addGlobalScope(new PostTypeScope);
    }

    /**
     * Get the Post title.
     *
     * @return string
     */
    public function getTitleAttribute(): string
    {
        return $this->post_title;
    }

    /**
     * Get the Post content.
     */
    public function getContentAttribute(): string
    {
        return $this->post_content;
    }

    /**
     * Get the Post status.
     */
    public function getStatusAttribute(): string
    {
        return $this->post_status;
    }

    /**
     * Get the Post type.
     */
    public function getTypeAttribute(): string
    {
        return $this->post_type;
    }

    /**
     * Get the Post slug.
     */
    public function getSlugAttribute(): string
    {
        return $this->post_name;
    }

    /**
     * Get the created at date.
     *
     * @return Carbon\Carbon
     */
    public function getCreatedAtAttribute(): Carbon
    {
        return $this->post_date;
    }

    /**
     * Get the updated at date.
     *
     * @return Carbon\Carbon
     */
    public function getUpdatedAtAttribute(): Carbon
    {
        return $this->post_modified;
    }

    /**
     * Return the featured image HTML.
     *
     * @param string|array $size
     * @param string|array $attr
     * @return string
     */
    public function featuredImage($size = 'post-thumbnail', $attr = ''): string
    {
        return wp_get_attachment_image((int) $this->getMeta('_thumbnail_id'), $size, false, $attr);
    }

    /**
     * Scope the Post query to published posts.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('post_status', '=', 'publish');
    }

    /**
     * Get the Post author.
     *
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function author(): Relation
    {
        return $this->belongsTo(User::class, 'post_author', 'ID');
    }

    /**
     * Get the Post comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function comments(): Relation
    {
        return $this->hasMany(Comment::class, 'comment_post_ID', 'ID');
    }

    /**
     * Get the Post meta.
     *
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function meta(): Relation
    {
        return $this->hasMany(PostMeta::class, 'post_id', 'ID');
    }

    /**
     * Get the Post attachments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function attachments(): Relation
    {
        return $this->hasMany(Attachment::class, 'post_parent', 'ID');
    }

    /**
     * Get the Post terms.
     *
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function terms(): Relation
    {
        return $this->hasManyThrough(
            Taxonomy::class,
            TermRelationship::class,
            'object_id',
            'term_taxonomy_id'
        );
    }

    /**
     * Get the Post categories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function categories(): Relation
    {
        return $this->terms()->where('taxonomy', '=', 'category');
    }

    /**
     * Get the Post tags.
     *
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function tags(): Relation
    {
        return $this->terms()->where('taxonomy', '=', 'post_tag');
    }
}
