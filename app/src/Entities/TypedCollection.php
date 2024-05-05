<?php

namespace App\src\Entities;

use Illuminate\Support\Collection;
use InvalidArgumentException;

/**
 * @template TKey of array-key
 * @template TValue
 *
 * @extends Collection<TKey, TValue>
 */
abstract class TypedCollection extends Collection
{
    /** @var list<class-string> */
    protected static array $allowedTypes = [];

    public function __construct($items = [])
    {
        $this->assertValidTypes(...$items);

        parent::__construct($items);
    }

    /**
     * Push one or more items onto the end of the collection.
     *
     * @param TValue ...$values
     *
     * @return $this
     */
    public function push(...$values): self
    {
        foreach ($values as $value) {
            $this->assertValidType($value);
        }

        return parent::push(...$values);
    }

    /**
     * @param TKey $key
     * @param TValue $value
     */
    public function offsetSet($key, $value): void
    {
        $this->assertValidType($value);

        parent::offsetSet($key, $value);
    }

    /**
     * @param TValue $value
     * @param ?TKey $key
     */
    public function prepend($value, $key = null): self
    {
        $this->assertValidType($value);

        return parent::prepend($value, $key);
    }

    /**
     * @param TValue $value
     */
    public function add($value): self
    {
        $this->assertValidType($value);

        return parent::add($value);
    }

    public function map(callable $callback): Collection
    {
        return $this->untyped()->map($callback);
    }

    public function pluck($value, $key = null): Collection
    {
        return $this->untyped()->pluck($value, $key);
    }

    /**
     * @return Collection<int, TKey>
     */
    public function keys(): Collection
    {
        return $this->untyped()->keys();
    }

    /**
     * @return array<TKey, mixed>
     */
    public function toArray(): array
    {
        return $this->untyped()->toArray();
    }

    /**
     * Returns an untyped collection with all items
     *
     * @return Collection<TKey, TValue>
     */
    public function untyped(): Collection
    {
        return Collection::make($this->items);
    }

    /**
     * @param mixed ...$items
     *
     * @throws InvalidArgumentException
     */
    protected function assertValidTypes(...$items): void
    {
        foreach ($items as $item) {
            $this->assertValidType($item);
        }
    }

    /**
     * @param mixed $item
     *
     * @throws InvalidArgumentException
     */
    protected function assertValidType($item): void
    {
        foreach (static::$allowedTypes as $allowedType) {
            if ($item instanceof $allowedType) {
                return;
            }
        }

        throw new InvalidArgumentException(
            sprintf(
                'A %s collection only accepts objects of the following type(s): %s.',
                get_class($this),
                implode(', ', static::$allowedTypes)
            )
        );
    }
}