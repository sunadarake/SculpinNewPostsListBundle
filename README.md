# Sculpin New Posts List Bundle

3rd party Sculpin Bundle that creates new posts list

## Setup

```
composer require sunadarake/sculpin-new-posts-list-bundle
```
In your `app/SculpinKernel.php`

```php
<?php

use Sculpin\Bundle\SculpinBundle\HttpKernel\AbstractKernel;
use Darake\SculpinNewPostsListBundle;

class SculpinKernel extends AbstractKernel
{
    protected function getAdditionalSculpinBundles(): array
    {
        return [
            SculpinNewPostsListBundle::class,
        ];
    }
}
```

## How to use

In your template file, (for example `layout/default.html`)

```
<ul>
    {% for post in site.new_posts %}
    <li><a href="{{ site.url }}/{{ post.data.get('url') }}">{{ post.title }}</a></li>
    {% endfor %}
</ul>
```
In default configured, you can display 5 new posts. 

If you need to change number of new posts to display, configure number of posts in `app/config/sculpin_kernel.yml`.

```
sculpin_content_types:
    posts:
        permalink: pretty
sculpin_new_posts_list:
    max_per_page: 10
```
