<?php

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

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

if (!function_exists('transform_paginator')) {
    function transform_paginator(
        LengthAwarePaginator $paginator,
        $transformer
    ): LengthAwarePaginator {
        /** @var Collection $transformed */
        $transformed = $paginator->map("$transformer::staticToArray");

        $paginator->setCollection($transformed);

        return $paginator;
    }
}