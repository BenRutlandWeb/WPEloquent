<?php

namespace WPEloquent\Models;

use WPEloquent\Models\Post;

class Page extends Post
{
    /**
     * The post type for the model.
     *
     * @var string
     */
    public $postType = 'page';
}
