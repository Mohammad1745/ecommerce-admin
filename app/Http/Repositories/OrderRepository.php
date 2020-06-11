<?php
/**
 * Created by PhpStorm.
 * User: debu
 * Date: 7/5/19
 * Time: 7:31 PM
 */

namespace App\Http\Repositories;


use App\Models\Order;

class OrderRepository extends CommonRepository
{
    /**
     * UserRepository constructor.
     */
    public function __construct()
    {
        $model = new Order();
        parent::__construct($model);
    }

}
