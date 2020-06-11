<?php


namespace App\Http\Services;


use App\Http\Repositories\BrandRepository;
use App\Http\Repositories\ProductRepository;
use App\Http\Repositories\ProductShippingMethodRepository;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ProductService
{
    private $errorMessage;
    private $errorResponse;
    private $productRepository;
    private $brandRepository;
    private $productShippingMethodRepository;

    /**
     * ProductService constructor.
     * @param ProductRepository $productRepository
     * @param BrandRepository $brandRepository
     * @param ProductShippingMethodRepository $productShippingMethodRepository
     */
    public function __construct(ProductRepository $productRepository, BrandRepository $brandRepository, ProductShippingMethodRepository $productShippingMethodRepository)
    {
        $this->productRepository = $productRepository;
        $this->brandRepository = $brandRepository;
        $this->productShippingMethodRepository = $productShippingMethodRepository;
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
     * @return mixed
     */
    public function getAllBrands()
    {
        return $this->brandRepository->getAll();
    }

    /**
     * @param $product
     * @return array|mixed
     */
    public function getProductBrand($product)
    {
        try{
            $where = ['id' => $product->brand_id];
            return $this->brandRepository->whereFirst($where);
        }catch (\Exception $e){
            return $this->errorResponse;
        }
    }

    /**
     * @param $id
     * @return array
     */
    public function getProductById($id)
    {
        try{
            $id = decrypt($id);
            $product = $this->productRepository->getById($id);

            return [
                'success' => true,
                'message' => 'Product has been found.',
                'data' => $product,
                'webResponse' => [
                    'success' => 'Product has been found.',
                ],
            ];
        }catch (\Exception $e){

            return $this->errorResponse;
        }
    }

    /**
     * @param $data
     * @return array
     */
    public function storeProduct($data)
    {
        try{
            $preparedData = $this->prepareProductData($data);
            $product = $this->productRepository->create($preparedData);

            return [
                'success' => true,
                'message' => 'Product has been added.',
                'data' => $product,
                'webResponse' => [
                    'success' => 'Product has been added.',
                ],
            ];
        }catch (\Exception $e){

            return $this->errorResponse;
        }
    }

    /**
     * @param $data
     * @return array
     */
    public function prepareProductData($data) {
        $preparedData = [];
        $preparedData['name'] = $data['name'];
        $preparedData['description'] = $data['description'];
        $preparedData['brand_id'] = $data['brand_id'];
        $preparedData['regular_price'] = $data['regular_price'];
        $preparedData['sell_price'] = $data['sell_price'];
        $preparedData['quantity'] = $data['quantity'];

        return $preparedData;
    }

    /**
     * @param $data
     * @return array
     */
    public function updateProduct($data)
    {
        try{
            $where = ['id' => $data->id];
            $preparedData = $this->prepareUpdatedProductData($data);
            $this->productRepository->update($where, $preparedData);

            return [
                'success' => true,
                'message' => 'Product has been updated.',
                'data' => $data->id,
                'webResponse' => [
                    'success' => 'Product has been updated.',
                ],
            ];
        }catch (\Exception $e){

            return $this->errorResponse;
        }
    }

    /**
     * @param $data
     * @return array
     */
    public function prepareUpdatedProductData($data) {
        $preparedData = [];
        if(isset($data['name'])){
            $preparedData['name'] = $data['name'];
        }
        if(isset($data['description'])){
            $preparedData['description'] = $data['description'];
        }
        if(isset($data['brand_id'])){
            $preparedData['brand_id'] = $data['brand_id'];
        }
        if(isset($data['regular_price'])){
            $preparedData['regular_price'] = $data['regular_price'];
        }
        if(isset($data['sell_price'])){
            $preparedData['sell_price'] = $data['sell_price'];
        }
        if(isset($data['quantity'])){
            $preparedData['quantity'] = $data['quantity'];
        }

        return $preparedData;
    }

    /**
     * @param $id
     * @return array
     */
    public function deleteProduct($id)
    {
        try{
            $id = decrypt($id);
            $where = ['id' => $id];
            $response = $this->productRepository->deleteWhere($where);

            return [
                'success' => true,
                'message' => 'Product has been deleted.',
                'webResponse' => [
                    'success' => 'Product has been deleted.',
                ],
            ];
        }catch (\Exception $e){

            return $this->errorResponse;
        }
    }

    /**
     * @return array|JsonResponse|mixed
     */
    public function productListQuery() {
        $products = $this->productRepository->getAllQuery();
        try {
            return datatables($products)
                ->editColumn('name', function ($item) {
                    return $item->name;
                })
                ->addColumn('brand', function ($item) {
                    $brand = $this->brandRepository->getById($item->brand_id);
                    return $brand->name;
                })
                ->addColumn('regular_price', function ($item) {
                    return $item->regular_price;
                })
                ->addColumn('sell_price', function ($item) {
                    return $item->sell_price;
                })
                ->addColumn('quantity', function ($item) {
                    return $item->quantity;
                })
                ->addColumn('actions', function ($item) {
                    $generatedData = '<ul class="d-flex justify-content-center activity-menus mb-0">';

                    $generatedData .= '<a class="text-primary" href="';
                    $generatedData .= route('admin.productDetails', encrypt($item->id));
                    $generatedData .= '" data-toggle="tooltip" title="Show">';
                    $generatedData .= '<i class="fa fa-eye"></i>';
                    $generatedData .= '</a>';

                    $generatedData .= '<a class="ml-3 text-danger" href="';
                    $generatedData .= route('admin.deleteProduct', encrypt($item->id));
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

    /**
     * @param $productId
     * @return array
     */
    public function getProductShippingMethods($productId)
    {
        try {
            $productId = decrypt($productId);
            $where = ['product_id' => $productId];
            $productShippingMethods = $this->productShippingMethodRepository->getWhere($where);
            return [
                'success' => true,
                'message' => 'Variations',
                'data' => $productShippingMethods,
                'webResponse' => [
                    'dismiss' => 'Variations',
                ],
            ];
        }catch (\Exception $e){
            return $this->errorResponse;
        }
    }

    /**
     * @param $data
     * @return array
     */
    public function updateProductShippingMethods($data)
    {
        try{
            DB::beginTransaction();
            $this->deleteRemovedShippingMethods($data);
            $preparedShippingMethodData = $this->prepareProductShippingMethodsData($data);
            $this->productShippingMethodRepository->insert($preparedShippingMethodData);
            DB::commit();

            return [
                'success' => true,
                'message' => 'Product Shipping Methods has been updated.',
                'data' => $data->product_id,
                'webResponse' => [
                    'success' => 'Product Shipping Methods has been updated.',
                ],
            ];
        }catch (\Exception $e){
            DB::rollBack();
            dd($e->getMessage());
            return $this->errorResponse;
        }
    }

    /**
     * @param $data
     * @return array
     */
    public function deleteRemovedShippingMethods($data)
    {
        try{
            $deletedShippingMethods = [];
            $shippingMethods =  $data['shipping_methods'];
            $where = ['product_id' => $data['product_id']];
            $productShippingMethods = $this->productShippingMethodRepository->getWhere($where);
            foreach ($productShippingMethods as $productShippingMethod) {
                $deleteShippingMethod = true;
                foreach ($shippingMethods as $shippingMethod) {
                    if ($productShippingMethod->shipping_method == $shippingMethod) {
                        $deleteShippingMethod = false;
                        break;
                    }
                }
                if ($deleteShippingMethod) {
                    $where = ['id' => $productShippingMethod->id];
                    $this->productShippingMethodRepository->deleteWhere($where);
                    array_push($deletedShippingMethods, $productShippingMethod['shippingMethod']);
                }
            }

            return $deletedShippingMethods;
        }catch (\Exception $e){
            return $this->errorResponse;
        }
    }

    /**
     * @param $data
     * @return array
     */
    public function prepareProductShippingMethodsData($data)
    {
        $preparedData = [];
        $shippingMethods = $data['shipping_methods'];
        $where = ['product_id' => $data['product_id']];
        $productShippingMethods = $this->productShippingMethodRepository->getWhere($where);
        foreach ($shippingMethods as $shippingMethod){
            $newShippingMethod = true;
            foreach ($productShippingMethods as $productShippingMethod) {
                if ($productShippingMethod->shipping_method == $shippingMethod) {
                    $newShippingMethod = false;
                    break;
                }
            }
            if ($newShippingMethod) {
                array_push($preparedData, [
                    'product_id' => $data['product_id'],
                    'shipping_method' => $shippingMethod,
                    'created_at' => Carbon::now(),
                ]);
            }
        }

        return $preparedData;
    }
}
