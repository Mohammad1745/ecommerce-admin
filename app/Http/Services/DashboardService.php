<?php
/**
 * Created by PhpStorm.
 * User: debu
 * Date: 8/9/19
 * Time: 12:21 PM
 */

namespace App\Http\Services;

use App\Http\Repositories\UserRepository;
use App\Models\Order;
use App\Models\Product;
use App\User;
use Illuminate\Support\Facades\DB;
class DashboardService
{
    private $errorMessage;
    private $errorResponse;
    private $userRepository;

    /**
     * UserManagementService constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->errorMessage = __('Something went wrong');
        $this->errorResponse = [
            'success' => false,
            'message' => $this->errorMessage,
            'data' => [],
            'webResponse' => [
                'dismiss' => $this->errorMessage,
            ],
        ];
    }

    /**
     * @return array
     */
    public function dashboard()
    {
        try{
            $usersData = $this->prepareUsersInformation();
            $productsData = $this->prepareProductsInformation();
            $ordersData = $this->prepareOrdersInformation();
            $dashboardData = array_merge($usersData, $productsData, $ordersData);

            return [
                'success' => true,
                'message' => 'User Data',
                'data' => $dashboardData,
                'webResponse' => [
                    'success' => 'User Data',
                ],
            ];
        }catch (\Exception $e){
            return $this->errorResponse;
        }
    }

    /**
     * @return mixed
     */
    private function prepareUsersInformation()
    {
        $usersData['thisMonthUsers'] = User::where(['role' => USER_ROLE])->where('status', '!=', DELETE_STATUS)->whereRaw("created_at between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW()")->count();

        $status = DELETE_STATUS;
        $role = USER_ROLE;
        $newUsers = DB::select("select count(id) as countUser, MONTH(created_at) as month from users WHERE (created_at between  DATE_FORMAT(NOW() ,'%Y-01-01') AND NOW() ) and status !=  $status and role = $role GROUP BY YEAR(created_at), MONTH(created_at)");
        $totalUsers = User::count();
        $usersChartData = [];
        $maxUser = 1;
        for ($i = 0; $i <= 11; $i++) {
            foreach ($newUsers as $newUser) {
                if ($newUser->month - 1 == $i) {
                    $usersChartData[$i] = $newUser->countUser;
                }
                if ($maxUser < $newUser->countUser) {
                    $maxUser = $newUser->countUser;
                }
            }
            if (!isset($usersChartData[$i])) {
                $usersChartData[$i] = 0;
            }
        }
        $usersData['maxUsers'] = (int) ceil($maxUser / 100) * 100;
        $usersData['usersChartData'] = $usersChartData;
        $usersData['totalUsers'] = $totalUsers;

        return $usersData;
    }

    /**
     * @return mixed
     */
    private function prepareProductsInformation()
    {
        $productsData['thisMonthProducts'] = Product::whereRaw("created_at between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW()")->count();

        $newProducts = DB::select("select count(id) as countProduct, MONTH(created_at) as month from products WHERE (created_at between  DATE_FORMAT(NOW() ,'%Y-01-01') AND NOW() ) GROUP BY YEAR(created_at), MONTH(created_at)");
        $totalProducts = Product::count();
        $productsChartData = [];
        $maxProduct = 1;
        for ($i = 0; $i <= 11; $i++) {
            foreach ($newProducts as $newProduct) {
                if ($newProduct->month - 1 == $i) {
                    $productsChartData[$i] = $newProduct->countProduct;
                }
                if ($maxProduct < $newProduct->countProduct) {
                    $maxProduct = $newProduct->countProduct;
                }
            }
            if (!isset($productsChartData[$i])) {
                $productsChartData[$i] = 0;
            }
        }
        $productsData['maxProducts'] = (int) ceil($maxProduct / 100) * 100;
        $productsData['productsChartData'] = $productsChartData;
        $productsData['totalProducts'] = $totalProducts;

        return $productsData;
    }

    /**
     * @return mixed
     */
    private function prepareOrdersInformation()
    {
        $ordersData['thisMonthOrders'] = Order::whereRaw("created_at between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW()")->count();

        $newOrders = DB::select("select count(id) as countOrder, MONTH(created_at) as month from orders WHERE (created_at between  DATE_FORMAT(NOW() ,'%Y-01-01') AND NOW() ) GROUP BY YEAR(created_at), MONTH(created_at)");
        $totalOrders = Order::count();
        $ordersChartData = [];
        $maxOrder = 1;
        for ($i = 0; $i <= 11; $i++) {
            foreach ($newOrders as $newOrder) {
                if ($newOrder->month - 1 == $i) {
                    $ordersChartData[$i] = $newOrder->countOrder;
                }
                if ($maxOrder < $newOrder->countOrder) {
                    $maxOrder = $newOrder->countOrder;
                }
            }
            if (!isset($ordersChartData[$i])) {
                $ordersChartData[$i] = 0;
            }
        }
        $ordersData['maxOrders'] = (int) ceil($maxOrder / 100) * 100;
        $ordersData['ordersChartData'] = $ordersChartData;
        $ordersData['totalOrders'] = $totalOrders;

        return $ordersData;
    }
}
