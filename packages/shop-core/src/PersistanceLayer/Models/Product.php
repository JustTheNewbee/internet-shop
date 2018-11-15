<?php

namespace Shop\Core\PersistanceLayer\Models;

use Carbon\Carbon;
use Shop\Core\PersistanceLayer\ValueObjects\Product as ProductObject;

class Product extends BaseModel
{
    const TABLE = 'products';

    const ID = 'id';
    const NAME = 'name';
    const DESCRIPTION = 'description';
    const PRICE = 'price';
    const QUANTITY = 'quantity';
    const CATEGORY_ID = 'category_id';
    const IS_ACTIVE = 'is_active';

    protected $table = self::TABLE;

    protected $fillable = [
        self::NAME,
        self::DESCRIPTION,
        self::PRICE,
        self::QUANTITY,
        self::CATEGORY_ID,
        self::IS_ACTIVE,
    ];

    /**
     * @return ProductObject
     */
    public function toValueObject(): ProductObject
    {
        return new ProductObject(
            $this->id,
            $this->name,
            $this->description,
            $this->price,
            $this->quantity,
            $this->categoryId,
            $this->isActive === 0 ? false : true,
            $this->createdAt ? new Carbon($this->createdAt) : null,
            $this->updatedAt ? new Carbon($this->updatedAt) : null,
            $this->deletedAt ? new Carbon($this->deletedAt) : null
        );
    }
}
