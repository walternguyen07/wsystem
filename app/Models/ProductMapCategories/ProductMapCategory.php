<?php

namespace App\Models\ProductMapCategories;

use App\Models\BaseModel;

class ProductMapCategory extends BaseModel
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_map_categories';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
