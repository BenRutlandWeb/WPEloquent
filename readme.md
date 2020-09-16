# WPEloquent

Eloquent models for WordPress

## Introduction

WPEloquent uses Laravel's [Eloquent ORM](https://laravel.com/docs/8.x/eloquent)
to interact with WordPress' database.

WPEloquent comes with the following Models:

- Post
- Page
- Attachment
- PostMeta
- Term
- TermMeta
- User
- UserMeta
- Comment
- CommentMeta
- Option
- Taxonomy
- TermRelationship

---

## Getting started

Install the brw/wp-eloquent package

```bash
composer require brw/wp-eloquent
```

_functions.php_

```php
<?php

use WPEloquent\Database;

require __DIR__ . '/vendor/autoload.php';

// Basic usage
Database::connect();

// Advanced usage
Database::connect(
    [
        'driver'    => 'mysql',
        'prefix'    => 'wp_',
        'host'      => DB_HOST,
        'database'  => DB_NAME,
        'username'  => DB_USER,
        'password'  => DB_PASSWORD,
        'port'      => '3306',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ]
);
```

## The basics

Each model has relationships defined to interact with other models. As an 
example, the Post model has terms, author, comments and so on.

Full documentation on the Fluent API: [Eloquent ORM](https://laravel.com/docs/8.x/eloquent).

```php
<?php

use WPEloquent\Models\Post;

$posts = Post::limit(10)->where('post_status', 'publish')->get();

foreach ($posts as $post) : ?>
    <h2><?php echo $post->title; ?></h2>
    <p><?php echo $post->author->email; ?></p>
<?php endforeach;
```

---

## Extending Models

You can easily extend Models for Custom Post Types, or implement new Models for
custom tables.

### Custom Post Type

Define a new Model. For a custom post type, it's easiest to extend the
WPEloquent Post model, and change the `$postType` property.

```php
<?php

use WPEloquent\Models\Post;

class CustomPostType extends Post
{
    /**
     * The post type for the model.
     *
     * @var array|string
     */
    $postType = 'custom_post_type';
}
```

### Custom Model

To define a Model for a custom table, extend the WPEloquent Model and set the
`$table` property to the name of the table. This will be prefixed automatically.

```php
<?php

use WPEloquent\Models\Model;

class CustomTable extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'custom_table';
}
```

### TODO
- [ ] DB facade
- [ ] Update database connection to use `$wpdb` rather than creating a new connection.
- [ ] Improve database class to connect with a nicer API
- [ ] Add more documentation on Model relationships
