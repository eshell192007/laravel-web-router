# Laravel Web Router Extension

[![Packagist Version](https://img.shields.io/packagist/vpre/hoangtv2101/laravel-web-router.svg)](https://packagist.org/packages/hoangtv2101/laravel-web-router)
[![Travis Build Status](https://img.shields.io/travis/hoangtv2101/laravel-web-router.svg)](https://travis-ci.org/hoangtv2101/laravel-web-router)

## Introduction
This is an extention for laravel router, especially for web routing. Although, web action work around resource but you shouldn't follow REST to create
routing for web, because:

 1. Actually, your web application link(uri) does not follow REST architecture and it shouldn't.
There is a great speak about REST you could see on [GOTO Conferences](https://www.youtube.com/watch?v=pspy1H6A3FM).
 2. Action in REST is very different from web action.  
 Example: to create a post with REST you only send post request to a uri like:  
 ```POST: http://example.com/posts```  
 But to create a post in a normal web application you must follow these steps:  
     - Visit create post page: ```GET: http://example.com/create-post-page```  
     - Type something then submit: ```POST: http://example.com/create-post```  

Laravel web router extension idea is based on **CQRS(Command Query Responsibility Segregation)** pattern to make web routing easier. When using
this package, you can use only ```http://example.com/create-post``` URI to handle both query(GET) and command(POST) request.  

## Installation
```
composer require hoangtv2101/laravel-web-router
```

## Configuration  
open **config/app.php** then change ```Route``` facade:  
```php 
'Route' => Illuminate\Support\Facades\Route::class
```  
to:  
```php
'Route' => WebRouter\LaravelWebRouterExtension::class
```

## Example
In **routes/web.php** file:  
```php 
<?php

Route::web('create-post','Post\CreatePost');
```  
In **app/Http/Controllers/Post/CreatePost.php** file:

```php 
<?php  

namespace App\Http\Controllers\Post;  

use App\Http\Controllers\Controller;  

class CreatePost extends Controller {  

    /**
     * This method is used to change something
     */
    public function command() {
        //create post
    }  
    
    /**
     * This method is used to display something
     */
    public function query() {
        //display create post page
    }
    
}
```
