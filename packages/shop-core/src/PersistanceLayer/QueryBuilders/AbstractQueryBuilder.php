<?php

namespace Shop\Core\PersistanceLayer\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

abstract class AbstractQueryBuilder
{
    const MODEL = null;

    /**
     * @var Builder
     */
    protected $query;
    /**
     * @var array
     */
    protected $joinedTables = [];

    /**
     * @param string $key
     *
     * @return bool
     */
    public function isJoined(string $key): bool
    {
        if (array_key_exists($key, $this->joinedTables)) {
            return true;
        }
        $this->joinedTables[$key] = true;

        return false;
    }

    /**
     * @return $this
     */
    public function newQuery()
    {
        $query = clone $this;
        $query->query = (static::MODEL)::query();

        return $query;
    }

    /**
     * @throws \Exception
     *
     * @return Builder
     */
    public function getQuery(): Builder
    {
        if (!static::MODEL) {
            throw new \Exception('"MODEL" const should be defined in concrete query builder.');
        }
        if (!$this->query) {
            throw new \Exception('Query if empty. Init query by $qb->newQuery().');
        }

        return $this->query;
    }
}
