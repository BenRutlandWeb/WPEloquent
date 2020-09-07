<?php

namespace WPEloquent\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class PostTypeScope implements Scope
{
	public function apply(Builder $builder, Model $model)
	{
		$builder->where('post_type', '=', $model->postType);
	}
}