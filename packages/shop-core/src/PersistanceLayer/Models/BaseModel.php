<?php

namespace ShopCore\PersistanceLayer\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ShopCore\Contracts\ToValueObjectInterface;

abstract class BaseModel extends Model implements ToValueObjectInterface
{
    use SoftDeletes;
}
