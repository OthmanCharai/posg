<?php

namespace App\src\Repositories;

use App\src\Models\BaseModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    private ?BaseModel $baseModel = null;

    /**
     * Set Connection adn create new Query
     * @return Builder
     */
    public function getQueryBuilder(): Builder
    {
        return $this->getModel()
            ->newQuery();
    }

    /**
     * @return BaseModel
     */
    private function getModel(): BaseModel
    {
        if ($this->baseModel instanceof BaseModel) {
            return $this->baseModel;
        }
        $this->baseModel = app($this->getModelClass());

        return $this->baseModel;
    }

    /**
     * @param string $value
     * @param string $columnName
     *
     * @return Model|null
     */
    public function find(string $value, string $columnName = 'id'): ?Model
    {
        return $this->getQueryBuilder()
            ->where($columnName, $value)
            ->first();
    }

    /**
     * @param string $id
     * @param array $attributes
     *
     * @return bool
     */
    public function update(string $id, array $attributes): bool
    {
        return $this->getQueryBuilder()
                ->where($this->getModel()->getIdColumn(), $id)
                ->update($attributes) > 0;
    }

    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->getQueryBuilder()
            ->create($attributes);
    }

    /**
     * @param string $value
     * @param string $columnName
     *
     * @return bool
     */
    public function delete(string $value, string $columnName = 'id'): bool
    {
        return $this->getQueryBuilder()
                ->where($columnName, $value)
                ->delete() > 0;
    }

    /**
     * @return string
     */
    abstract public function getModelClass(): string;
}
