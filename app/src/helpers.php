<?php

use App\src\Models\UuidModel;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;
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

if (!function_exists('map_collection')) {
    /**
     * @param LengthAwarePaginator $paginator
     * @param callable $callable
     *
     * @return LengthAwarePaginator
     */
    function map_collection(
        \Illuminate\Database\Eloquent\Collection $paginator,
        callable $callable
    ): \Illuminate\Database\Eloquent\Collection {
        $paginator->map(bind($callable));

        return $paginator;
    }
}

if (!function_exists('transform_paginator')) {
    function transform_paginator(
        LengthAwarePaginator $paginator,
        $transformer
    ): LengthAwarePaginator {
        /** @var Collection $transformed */
        $transformed = $paginator->map("$transformer::transform");

        $paginator->setCollection($transformed);

        return $paginator;
    }
}

if (!function_exists('transform_collection')) {
    /**
     *
     * @param Illuminate\Support\Collection $collection
     * @param callable|string $transformer
     *
     * @return Illuminate\Support\Collection
     */
    function transform_collection(Collection $collection, callable|string $transformer): Illuminate\Support\Collection
    {
        return $collection->map("$transformer::transform");
    }
}

if (!function_exists('throw_if_null')) {
    function throw_if_null($data, Throwable $e): mixed
    {
        throw_if($data === null, $e);

        return $data;
    }
}

if (!function_exists('make')) {
    /**
     * @template TClass
     *
     * @param class-string<TClass> $class
     *
     * @return TClass
     * @throws BindingResolutionException|BindingResolutionException
     */
    function make(string $class)
    {
        return app()->make($class);
    }
}

if (!function_exists('load_relations')) {
    function load_relations(UuidModel $model, array $relations): Model
    {
        $model->load(implode(',', array_values($relations)));

        return $model;
    }
}