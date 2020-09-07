<?php

namespace WPEloquent\Traits;

trait HasMeta
{
	/**
	 * Get the meta value
	 *
	 * @param string $key
	 * @return mixed
	 */
	public function getMeta($key)
	{
		$value = $this->meta()
			->where('meta_key', '=', $key)
			->value('meta_value');

		return maybe_unserialize($value);
	}
}
