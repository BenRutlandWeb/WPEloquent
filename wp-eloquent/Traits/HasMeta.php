<?php

namespace WPEloquent\Traits;

trait HasMeta
{
	public function getMeta($key)
	{
		return $this->meta()
		            ->where('meta_key', $key)
								->value('meta_value');
	}
}