<?php

use Illuminate\Pagination\LengthAwarePaginator;

if (!function_exists('bind')) {
    /**
     * @param callable $callable
     *
     * @return Closure
     */
    function bind(callable $callable): Closure
    {
        return static function () use ($callable) {
            call_user_func_array($callable, func_get_args());
        };
    }
}

if (!function_exists('map_paginator')) {
    /**
     * @param LengthAwarePaginator $paginator
     * @param callable $callable
     *
     * @return LengthAwarePaginator
     */
    function map_paginator(
        LengthAwarePaginator $paginator,
        callable $callable
    ): LengthAwarePaginator {
        $paginator->collect()->map(bind($callable));

        return $paginator;
    }
}