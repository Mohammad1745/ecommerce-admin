<?php


namespace App\Http\Controllers\Web\Admin\Product;


use App\Http\Controllers\Controller;
use App\Http\Requests\Web\ProductStoreRequest;
use App\Http\Requests\Web\ProductUpdateRequest;
use App\Http\Services\ProductService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    private $productService;

    /**
     * ProductService constructor.
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @return Application|Factory|View
     */
    public function  productList()
    {
        $data['mainMenu'] = 'product';
        $data['pageTitle'] = __('Product List');

        return view('admin.product.list', $data);
    }

    /**
     * @return mixed
     */
    public function  getProductList()
    {
        return $this->productService->productListQuery();
    }

    /**
     * @return Application|Factory|View
     */
    public function  createProduct()
    {
        $data['mainMenu'] = 'product';
        $data['pageTitle'] = __('Create Product');
        $data['brands'] = $this->productService->getAllBrands();

        return view('admin.product.create', $data);
    }

    /**
     * @param ProductStoreRequest $request
     * @return RedirectResponse
     */
    public function  storeProduct(ProductStoreRequest $request)
    {
        $response = $this->productService->storeProduct($request);

        return $response['success'] ?
            redirect()->route('admin.productDetails', encrypt($response['data']['id']))->with($response['webResponse']) :
            redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param ProductUpdateRequest $request
     * @return RedirectResponse
     */
    public function  updateProduct(ProductUpdateRequest $request)
    {
        $response = $this->productService->updateProduct($request);

        return redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function deleteProduct($id)
    {
        $response = $this->productService->deleteProduct($id);

        return $response['success'] ?
            redirect()->route('admin.productList')->with($response['webResponse']) :
            redirect()->back()->with($response['webResponse']);
    }
}
