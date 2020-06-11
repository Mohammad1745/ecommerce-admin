<?php


namespace App\Http\Controllers\Web\Admin\FlashSale;


use App\Http\Controllers\Controller;
use App\Http\Requests\Web\FlashSaleStoreRequest;
use App\Http\Requests\Web\FlashSaleUpdateRequest;
use App\Http\Services\FlashSaleService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FlashSaleController extends Controller
{
    private $flashSaleService;

    public function __construct(FlashSaleService $flashSaleService)
    {
        $this->flashSaleService = $flashSaleService;
    }

    /**
     * @return Application|Factory|View
     */
    public function  flashSaleList()
    {
        $data['mainMenu'] = 'flash_sale_product';
        $data['pageTitle'] = __('Flash Sale List');

        return view('admin.flash_sale.list', $data);
    }

    /**
     * @return array|JsonResponse|mixed
     */
    public function  getFlashSaleList()
    {
        return $this->flashSaleService->flashSaleListQuery();
    }

    /**
     * @return Application|Factory|View
     */
    public function  createFlashSale()
    {
        $data['mainMenu'] = 'flash_sale_product';
        $data['pageTitle'] = __('Create Flash Sale');
        $data['products'] = $this->flashSaleService->getAllProductsWithNotFlashSale();

        return view('admin.flash_sale.create', $data);
    }

    /**
     * @param FlashSaleStoreRequest $request
     * @return RedirectResponse
     */
    public function  storeFlashSale(FlashSaleStoreRequest $request)
    {
        $response = $this->flashSaleService->storeFlashSaleProduct($request);

        return $response['success'] ?
            redirect()->route('admin.flashSaleList')->with($response['webResponse']) :
            redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param $id
     * @return Application|Factory|RedirectResponse|View
     */
    public function  editFlashSale($id)
    {
        $data['mainMenu'] = 'flash_sale';
        $data['pageTitle'] = __('Edit Flash Sale');
        $data['products'] = $this->flashSaleService->getAllProductsWithNotFlashSale();
        $response = $this->flashSaleService->getFlashSaleById($id);
        $flashSaleProduct = $this->flashSaleService->getFlashSaleProduct($response['data']['product_id']);
        if($response['success']){
            $data['flashSale'] = $response['data'];
            $data['flashSaleProduct'] = $flashSaleProduct;

            return view('admin.flash_sale.edit', $data);
        }
        return redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param FlashSaleUpdateRequest $request
     * @return RedirectResponse
     */
    public function  updateFlashSale(FlashSaleUpdateRequest $request)
    {
        $response = $this->flashSaleService->updateFlashSale($request);

        return $response['success'] ?
            redirect()->route('admin.flashSaleList')->with($response['webResponse']) :
            redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function  deleteFlashSale($id)
    {
        $response = $this->flashSaleService->deleteFlashSale($id);

        return $response['success'] ?
            redirect()->route('admin.flashSaleList')->with($response['webResponse']) :
            redirect()->back()->with($response['webResponse']);
    }
}
