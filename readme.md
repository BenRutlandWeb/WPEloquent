# WPEloquent

Eloquent models for WordPress

## TODO

[WPDB schema](https://codex.wordpress.org/images/8/83/WP_27_dbsERD.png)

- Post->hasMany(TermRelationship)???
- TermRelationship->belongsTo(Post)???
- TermRelationship->belongsTo(Taxonomy)???
- Taxonomy->hasMany(TermRelationship)???
- Taxonomy->belongsTo(Term)
- Term->hasMany(Taxonomy)

## Models

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
- ~~Taxonomy~~
- ~~TermRelationship~~

## Usage

_functions.php_

```php
<?php

use WPEloquent\Database;

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

_index.php_

```php
<?php

use WPEloquent\Models\Post;

$posts = Post::limit(10)->where('post_status', 'publish')->get();

$posts->each(function($post) {
    // extract into a partial
    echo '<h2>' . $post->title . '</h2>';
    echo '<p>' . $post->author->email . '</p>';

});

```
