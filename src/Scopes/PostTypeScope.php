<?php

namespace WPEloquent\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class PostTypeScope implements Scope
{
    /**
     * Apply the post_type scope to the query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model    $model
     * @return void
     */
    public function apply(Builder $builder, Model $model): void
    {
        $builder->whereIn(
            'post_type',
            !is_array($model->postType) ? [$model->postType] : $model->postType
        );
    }
}
