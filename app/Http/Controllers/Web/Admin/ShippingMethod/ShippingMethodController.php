<?php


namespace App\Http\Controllers\Web\Admin\ShippingMethod;


use App\Http\Controllers\Controller;
use App\Http\Requests\Web\ShippingMethodStoreRequest;
use App\Http\Requests\Web\ShippingMethodUpdateRequest;
use App\Http\Services\ShippingMethodService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ShippingMethodController extends Controller
{
    private $shippingMethodService;

    /**
     * ShippingMethodService constructor.
     * @param ShippingMethodService $shippingMethodService
     */
    public function __construct(ShippingMethodService $shippingMethodService)
    {
        $this->shippingMethodService = $shippingMethodService;
    }

    /**
     * @return Application|Factory|View
     */
    public function  shippingMethodList()
    {
        $data['mainMenu'] = 'shipping_method';
        $data['pageTitle'] = __('Shipping Method List');

        return view('admin.shipping_method.list', $data);
    }

    /**
     * @return mixed
     */
    public function  getShippingMethodList()
    {
        return $this->shippingMethodService->shippingMethodListQuery();
    }

    /**
     * @return Application|Factory|View
     */
    public function  createShippingMethod()
    {
        $data['mainMenu'] = 'shipping_method';
        $data['pageTitle'] = __('Create Shipping Method');

        return view('admin.shipping_method.create', $data);
    }

    /**
     * @param ShippingMethodStoreRequest $request
     * @return RedirectResponse
     */
    public function  storeShippingMethod(ShippingMethodStoreRequest $request)
    {
        $response = $this->shippingMethodService->storeShippingMethod($request);

        return $response['success'] ?
            redirect()->route('admin.shippingMethodList')->with($response['webResponse']) :
            redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param $id
     * @return Application|Factory|RedirectResponse|View
     */
    public function  editShippingMethod($id)
    {
        $data['mainMenu'] = 'shipping_method';
        $data['pageTitle'] = __('Edit Shipping Method');
        $response = $this->shippingMethodService->getShippingMethodById($id);
        if($response['success']){
            $data['shippingMethod'] = $response['data'];

            return view('admin.shipping_method.edit', $data);
        }
        return redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param ShippingMethodUpdateRequest $request
     * @return RedirectResponse
     */
    public function  updateShippingMethod(ShippingMethodUpdateRequest $request)
    {
        $response = $this->shippingMethodService->updateShippingMethod($request);

        return redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function deleteShippingMethod($id)
    {
        $response = $this->shippingMethodService->deleteShippingMethod($id);

        return $response['success'] ?
            redirect()->route('admin.shippingMethodList')->with($response['webResponse']) :
            redirect()->back()->with($response['webResponse']);
    }
}
