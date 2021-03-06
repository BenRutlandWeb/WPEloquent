<?php

namespace WPEloquent\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use WPEloquent\Models\Comment;
use WPEloquent\Models\Post;
use WPEloquent\Models\UserMeta;
use WPEloquent\Traits\HasMeta;
use WPEloquent\Traits\HasRoles;

class User extends Model
{
    use HasMeta;
    use HasRoles;

    /**
     * The name of the "created at" column.
     *
     * @var string
     */
    const CREATED_AT = 'user_registered';

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
    protected $table = 'users';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * Get the User name.
     *
     * @return string
     */
    public function getNameAttribute(): string
    {
        return $this->display_name;
    }

    /**
     * Get the User name.
     *
     * @return string
     */
    public function getFirstNameAttribute(): string
    {
        return $this->getMeta('first_name');
    }

    /**
     * Get the User name.
     *
     * @return string
     */
    public function getLastNameAttribute(): string
    {
        return $this->getMeta('last_name');
    }

    /**
     * Get the User email address.
     *
     * @return string
     */
    public function getEmailAttribute(): string
    {
        return $this->user_email;
    }

    /**
     * Get the created at date.
     *
     * @return Carbon\Carbon
     */
    public function getCreatedAtAttribute(): Carbon
    {
        return $this->user_registered;
    }

    /**
     * Get the User posts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function posts(): Relation
    {
        return $this->hasMany(Post::class, 'post_author');
    }

    /**
     * Get the User comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function comments(): Relation
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    /**
     * Get the User meta.
     *
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function meta(): Relation
    {
        return $this->hasMany(UserMeta::class, 'user_id');
    }
}
