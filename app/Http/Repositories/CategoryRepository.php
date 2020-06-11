<?php
/**
 * Created by PhpStorm.
 * User: debu
 * Date: 7/5/19
 * Time: 7:31 PM
 */

namespace App\Http\Repositories;

use App\Models\Category;

class CategoryRepository extends CommonRepository
{
    /**
     * UserRepository constructor.
     */
    public function __construct()
    {
        $model = new Category();
        parent::__construct($model);
    }
}
