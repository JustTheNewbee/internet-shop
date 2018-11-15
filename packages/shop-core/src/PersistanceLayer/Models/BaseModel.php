<?php

namespace Shop\Core\PersistanceLayer\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Shop\Core\Contracts\ToValueObjectInterface;

abstract class BaseModel extends Model implements ToValueObjectInterface
{
    use SoftDeletes;
}
