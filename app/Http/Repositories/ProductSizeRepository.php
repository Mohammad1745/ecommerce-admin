<?php
/**
 * Created by PhpStorm.
 * User: debu
 * Date: 7/5/19
 * Time: 7:31 PM
 */

namespace App\Http\Repositories;


use App\Models\ProductSize;

class ProductSizeRepository extends CommonRepository
{
    /**
     * UserRepository constructor.
     */
    public function __construct()
    {
        $model = new ProductSize();
        parent::__construct($model);
    }

}
