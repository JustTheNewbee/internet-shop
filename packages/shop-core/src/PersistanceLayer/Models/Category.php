<?php

namespace ShopCore\PersistanceLayer\Models;

use Carbon\Carbon;
use ShopCore\PersistanceLayer\ValueObjects\Category as CategoryObject;

class Category extends BaseModel
{
    const TABLE = 'categories';

    const ID = 'id';
    const NAME = 'name';
    const DESCRIPTION = 'description';
    const KEY = 'key';
    const IS_ACTIVE = 'is_active';

    protected $table = self::TABLE;

    protected $fillable = [
        self::NAME,
        self::DESCRIPTION,
        self::KEY,
        self::IS_ACTIVE
    ];

    /**
     * @return CategoryObject
     */
    public function toValueObject(): CategoryObject
    {
        return new CategoryObject(
            $this->id,
            $this->name,
            $this->description,
            $this->key,
            boolval($this->is_active),
            $this->created_at ? new Carbon($this->created_at) : null,
            $this->updated_at ? new Carbon($this->updated_at) : null,
            $this->deleted_at ? new Carbon($this->deleted_at) : null
        );
    }
}
