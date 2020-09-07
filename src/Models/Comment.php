<?php

namespace WPEloquent\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use WPEloquent\Traits\HasMeta;

class Comment extends Model
{
    use HasMeta;

    /**
     * The name of the "created at" column.
     *
     * @var string
     */
    const CREATED_AT = 'comment_date';

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
    protected $table = 'comments';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'comment_ID';

    /**
     * Get the comment content.
     *
     * @return string
     */
    public function getContentAttribute(): string
    {
        return $this->comment_content;
    }

    /**
     * Get the created at date.
     *
     * @return Carbon\Carbon
     */
    public function getCreatedAtAttribute(): Carbon
    {
        return $this->comment_date;
    }

    /**
     * Get the Comment post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function post(): Relation
    {
        return $this->belongsTo(Post::class, 'comment_post_ID', 'ID');
    }

    /**
     * Get the Comment meta.
     *
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function meta(): Relation
    {
        return $this->hasMany(CommentMeta::class, 'comment_id', 'comment_ID');
    }

    /**
     * Get the Comment author.
     *
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function author(): Relation
    {
        return $this->belongsTo(User::class, 'user_id', 'ID');
    }
}
