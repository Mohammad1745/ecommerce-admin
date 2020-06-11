<?php


namespace App\Http\Controllers\Web\Admin\Product;


use App\Http\Controllers\Controller;
use App\Http\Requests\Web\ProductAttributesUpdateRequest;
use App\Http\Requests\Web\ProductShippingMethodsUpdateRequest;
use App\Http\Requests\Web\ProductVariationImageUpdateRequest;
use App\Http\Requests\Web\ProductVariationsUpdateRequest;
use App\Http\Services\ProductAttributeService;
use App\Http\Services\ProductService;
use App\Http\Services\ProductVariationService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductDetailsController extends Controller
{
    private $productService;
    private $productAttributeService;
    private $productVariationService;

    /**
     * ProductService constructor.
     * @param ProductService $productService
     * @param ProductAttributeService $productAttributeService
     * @param ProductVariationService $productVariationService
     */
    public function __construct(ProductService $productService, ProductAttributeService $productAttributeService, ProductVariationService $productVariationService)
    {
        $this->productService = $productService;
        $this->productAttributeService = $productAttributeService;
        $this->productVariationService = $productVariationService;
    }

    /**
     * @param $id
     * @return Application|Factory|RedirectResponse|View
     */
    public function  productDetails($id)
    {
        $data['mainMenu'] = 'product';
        $data['subMenu'] = 'general';
        $data['pageTitle'] = __('Product Information');
        $data['brands'] = $this->productService->getAllBrands();
        $response = $this->productService->getProductById($id);
        if($response['success']){
            $data['product'] = $response['data'];

            return view('admin.product.general', $data);
        }
        return redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param $id
     * @return Application|Factory|RedirectResponse|View
     */
    public function  productAttributes($id)
    {
        $data['mainMenu'] = 'product';
        $data['subMenu'] = 'attributes';
        $data['pageTitle'] = __('Product Information');
        $response = $this->productService->getProductById($id);
        $colorData = $this->productAttributeService->getProductColors($id);
        $sizeData = $this->productAttributeService->getProductSizes($id);
        if($response['success']){
            $data['product'] = $response['data'];
            $data['productColors'] = $colorData['data'];
            $data['productSizes'] = $sizeData['data'];

            return view('admin.product.attributes', $data);
        }
        return redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param ProductAttributesUpdateRequest $request
     * @return RedirectResponse
     */
    public function  updateProductAttributes(ProductAttributesUpdateRequest $request)
    {
        $response = $this->productAttributeService->updateProductAttributes($request);

        return redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param $id
     * @return Application|Factory|RedirectResponse|View
     */
    public function  productPriceAndQuantity($id)
    {
        $data['mainMenu'] = 'product';
        $data['subMenu'] = 'price_and_quantity';
        $data['pageTitle'] = __('Product Information');
        $data['settings'] = allSetting();
        $response = $this->productService->getProductById($id);
        if($response['success']){
            $data['product'] = $response['data'];

            return view('admin.product.price_and_quantity', $data);
        }
        return redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param $id
     * @return Application|Factory|RedirectResponse|View
     */
    public function  productDescription($id)
    {
        $data['mainMenu'] = 'product';
        $data['subMenu'] = 'description';
        $data['pageTitle'] = __('Product Information');
        $response = $this->productService->getProductById($id);
        if($response['success']){
            $data['product'] = $response['data'];

            return view('admin.product.description', $data);
        }
        return redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param $id
     * @return Application|Factory|RedirectResponse|View
     */
    public function  productVariations($id)
    {
        $data['mainMenu'] = 'product';
        $data['subMenu'] = 'variations';
        $data['pageTitle'] = __('Product Information');
        $productVariations = $this->productVariationService->productVariations($id);
        $response = $this->productService->getProductById($id);
        if($response['success']){
            $data['product'] = $response['data'];
            $data['productVariations'] = $productVariations['data'];

            return view('admin.product.variations', $data);
        }
        return redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param ProductVariationsUpdateRequest $request
     * @return RedirectResponse
     */
    public function  updateProductVariations(ProductVariationsUpdateRequest $request)
    {
        $response = $this->productVariationService->updateProductVariations($request);

        return redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param $id
     * @return Application|Factory|RedirectResponse|View
     */
    public function  productVariationImages($id)
    {
        $data['mainMenu'] = 'product';
        $data['subMenu'] = 'images';
        $data['pageTitle'] = __('Product Images');
        $productVariations = $this->productVariationService->productVariationsWithImages($id);
        $response = $this->productService->getProductById($id);
        if($response['success']){
            $data['product'] = $response['data'];
            $data['productVariations'] = $productVariations['data'];

            return view('admin.product.images', $data);
        }
        return redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param ProductVariationImageUpdateRequest $request
     * @return RedirectResponse
     */
    public function  updateProductVariationImages(ProductVariationImageUpdateRequest $request)
    {
        $response = $this->productVariationService->updateProductVariationImages($request);

        return redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param $id
     * @return Application|Factory|RedirectResponse|View
     */
    public function  productShippingMethods($id)
    {
        $data['mainMenu'] = 'product';
        $data['subMenu'] = 'shipping_method';
        $data['pageTitle'] = __('Product Shipping Method');
        $productShippingMethods = $this->productService->getProductShippingMethods($id);
        $response = $this->productService->getProductById($id);
        if($response['success']){
            $data['product'] = $response['data'];
            $data['productShippingMethods'] = $productShippingMethods['data'];

            return view('admin.product.shipping_methods', $data);
        }
        return redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param ProductShippingMethodsUpdateRequest $request
     * @return RedirectResponse
     */
    public function  updateProductShippingMethods(ProductShippingMethodsUpdateRequest $request)
    {
        $response = $this->productService->updateProductShippingMethods($request);

        return redirect()->back()->with($response['webResponse']);
    }

}
