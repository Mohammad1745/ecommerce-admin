<?php

namespace App\Http\Services;

use App\Http\Repositories\OrderRepository;
use App\Http\Repositories\UserRepository;

class OrderService
{
    private $errorMessage;
    private $errorResponse;
    private $orderRepository;
    private $userRepository;

    /**
     * OrderService constructor.
     * @param OrderRepository $orderRepository
     * @param UserRepository $userRepository
     */
    public function __construct(OrderRepository $orderRepository, UserRepository $userRepository)
    {
        $this->orderRepository = $orderRepository;
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
     * @param $id
     * @return array
     */
    public function makeOrderProcessing($id)
    {
        try{
            $id = decrypt($id);
            $where = ['id' => $id];
            $data = ['delivery_status' => DELIVERY_PROCESSING_STATUS];
            $this->orderRepository->update($where, $data);

            return [
                'success' => true,
                'message' => 'Order has been updated.',
                'webResponse' => [
                    'success' => 'Order has been updated.',
                ],
            ];
        }catch (\Exception $e){

            return $this->errorResponse;
        }
    }

    /**
     * @param $id
     * @return array
     */
    public function makeOrderCompleted($id)
    {
        try{
            $id = decrypt($id);
            $where = ['id' => $id];
            $data = ['delivery_status' => DELIVERY_COMPLETED_STATUS];
            $this->orderRepository->update($where, $data);

            return [
                'success' => true,
                'message' => 'Order has been updated.',
                'webResponse' => [
                    'success' => 'Order has been updated.',
                ],
            ];
        }catch (\Exception $e){

            return $this->errorResponse;
        }
    }

    /**
     * @param $id
     * @return array
     */
    public function makeOrderCancelled($id)
    {
        try{
            $id = decrypt($id);
            $where = ['id' => $id];
            $data = ['delivery_status' => DELIVERY_CANCELLED_STATUS];
            $this->orderRepository->update($where, $data);

            return [
                'success' => true,
                'message' => 'Order has been updated.',
                'webResponse' => [
                    'success' => 'Order has been updated.',
                ],
            ];
        }catch (\Exception $e){

            return $this->errorResponse;
        }
    }

    /**
     * @param $id
     * @return array
     */
    public function deleteOrder($id)
    {
        try{
            $id = decrypt($id);
            $where = ['id' => $id];
            $response = $this->orderRepository->deleteWhere($where);

            return [
                'success' => true,
                'message' => 'Order has been deleted.',
                'webResponse' => [
                    'success' => 'Order has been deleted.',
                ],
            ];
        }catch (\Exception $e){

            return $this->errorResponse;
        }
    }

    /**
     * @return array|\Illuminate\Http\JsonResponse|mixed
     */
    public function orderListQuery() {
        $orders = $this->orderRepository->getAllQuery();
        try {
            return datatables($orders)
                ->addColumn('order_code', function ($item) {
                    return '#' . $item->order_code;
                })
                ->addColumn('customer_name', function ($item) {
                    $where = ['id' => $item->user_id];
                    $customer = $this->userRepository->whereFirst($where);

                    return $customer->first_name . ' ' . $customer->last_name;
                })
                ->addColumn('total_price', function ($item) {
                    return '$' . $item->total_price;
                })
                ->addColumn('payment_status', function ($item) {
                    return paymentStatus($item->payment_status);
                })
                ->addColumn('delivery_status', function ($item) {
                    return deliveryStatus($item->delivery_status);
                })
                ->addColumn('created_at', function ($item) {
                    return $item->created_at;
                })
                ->addColumn('actions', function ($item) {
                    $generatedData = '<ul class="d-flex justify-content-center activity-menus mb-0">';

                    $generatedData .= '<a class="ml-3 text-success" href="';
                    $generatedData .= route('admin.makeOrderCompleted', encrypt($item->id));
                    $generatedData .= '" data-toggle="tooltip" title="Make Order Completed" onclick="return confirm(\'Confirm to make order complete?\');">';
                    $generatedData .= '<i class="fa fa-check"></i>';
                    $generatedData .= '</a>';

                    $generatedData .= '<a class="ml-3 text-dark" href="';
                    $generatedData .= route('admin.makeOrderProcessing', encrypt($item->id));
                    $generatedData .= '" data-toggle="tooltip" title="Make Order Processing" onclick="return confirm(\'Confirm to make order processing?\');">';
                    $generatedData .= '<i class="fa fa-spinner"></i>';
                    $generatedData .= '</a>';

                    $generatedData .= '<a class="ml-3 text-danger" href="';
                    $generatedData .= route('admin.makeOrderCancelled', encrypt($item->id));
                    $generatedData .= '" data-toggle="tooltip" title="Cancel Order" onclick="return confirm(\'Are you sure to cancel this ?\');">';
                    $generatedData .= '<i class="fa fa-crosshairs"></i>';
                    $generatedData .= '</a>';

                    $generatedData .= '<a class="ml-3 text-danger" href="';
                    $generatedData .= route('admin.deleteOrder', encrypt($item->id));
                    $generatedData .= '" data-toggle="tooltip" title="Delete" onclick="return confirm(\'Are you sure to delete this ?\');">';
                    $generatedData .= '<i class="fa fa-trash"></i>';
                    $generatedData .= '</a>';
                    $generatedData .= '</ul>';

                    return $generatedData;
                })
                ->rawColumns(['actions'])
                ->make(true);
        } catch (\Exception $e) {
            return [];
        }
    }
}
