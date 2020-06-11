<?php


namespace App\Http\Controllers\Web\Admin\Order;


use App\Http\Controllers\Controller;
use App\Http\Requests\Web\OrderStoreRequest;
use App\Http\Requests\Web\OrderUpdateRequest;
use App\Http\Services\OrderAttributeService;
use App\Http\Services\OrderService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OrderController extends Controller
{
    private $orderService;

    /**
     * OrderService constructor.
     * @param OrderService $orderService
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * @return Application|Factory|View
     */
    public function  orderList()
    {
        $data['mainMenu'] = 'order';
        $data['pageTitle'] = __('Order List');

        return view('admin.order.list', $data);
    }

    /**
     * @return mixed
     */
    public function  getOrderList()
    {
        return $this->orderService->orderListQuery();
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function makeOrderProcessing($id)
    {
        $response = $this->orderService->makeOrderProcessing($id);

        return $response['success'] ?
            redirect()->route('admin.orderList')->with($response['webResponse']) :
            redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function makeOrderCompleted($id)
    {
        $response = $this->orderService->makeOrderCompleted($id);

        return $response['success'] ?
            redirect()->route('admin.orderList')->with($response['webResponse']) :
            redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function makeOrderCancelled($id)
    {
        $response = $this->orderService->makeOrderCancelled($id);

        return $response['success'] ?
            redirect()->route('admin.orderList')->with($response['webResponse']) :
            redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function deleteOrder($id)
    {
        $response = $this->orderService->deleteOrder($id);

        return $response['success'] ?
            redirect()->route('admin.orderList')->with($response['webResponse']) :
            redirect()->back()->with($response['webResponse']);
    }
}
