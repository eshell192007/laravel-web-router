<?php

namespace WebRouter;

use Illuminate\Support\Facades\Route;
use Request;

class LaravelWebRouterExtension extends Route {

    public static function web(...$args) {
        if (!isset($args[1])) {
            throw new \RuntimeException('Missing argument 2 when call Route::web()');
        }

        $action = $args[1];
        if (!is_string($action)) {
            throw new \RuntimeException('Argument 2 of Route::web() method must be a string');
        }

        if (Request::isMethod('get')) {
            $args[1] = $action . '@query';
            return self::get(...$args);
        }

        $args[1] = $action . '@command';
        return self::post(...$args);
    }

    public static function command(...$args) {
        if (!isset($args[1])) {
            throw new \RuntimeException('Missing argument 2 when call Route::command()');
        }

        $action = $args[1];
        if (!is_string($action)) {
            throw new \RuntimeException('Argument 2 of Route::command() method must be a string');
        }

        $args[1] = $action . '@command';
        return self::post(...$args);
    }

    public static function query(...$args) {
        if (!isset($args[1])) {
            throw new \RuntimeException('Missing argument 2 when call Route::query()');
        }

        $action = $args[1];
        if (!is_string($action)) {
            throw new \RuntimeException('Argument 2 of Route::query() method must be a string');
        }

        $args[1] = $action . '@query';
        return self::get(...$args);
    }

}
