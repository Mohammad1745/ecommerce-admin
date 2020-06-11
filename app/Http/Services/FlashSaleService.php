<?php


namespace App\Http\Services;



use App\Http\Repositories\FlashSaleProductRepository;
use App\Http\Repositories\ProductRepository;
use Carbon\Carbon;

class FlashSaleService
{
    private $errorMessage;
    private $errorResponse;
    private $productRepository;
    private $flashSaleProductRepository;

    /**
     * CategoryService constructor.
     * @param ProductRepository $productRepository
     * @param FlashSaleProductRepository $flashSaleProductRepository
     */
    public function __construct(ProductRepository $productRepository, FlashSaleProductRepository $flashSaleProductRepository)
    {
        $this->productRepository = $productRepository;
        $this->flashSaleProductRepository = $flashSaleProductRepository;
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
    public function getAllFlashSales()
    {
        $orderBy = ['id', 'desc'];
        return $this->flashSaleProductRepository->getAll($orderBy);
    }

    /**
     * @param $id
     * @return array
     */
    public function getFlashSaleById($id)
    {
        try{
            $id = decrypt($id);
            $flashSale = $this->flashSaleProductRepository->getById($id);
            $expiresAt = new Carbon($flashSale->expires_at);
            $flashSale['expires_at'] = date_format($expiresAt, 'Y-m-d\Th:m');

            return [
                'success' => true,
                'message' => 'Flash Sale Product',
                'data' => $flashSale,
                'webResponse' => [
                    'success' => 'Flash Sale Product',
                ],
            ];
        }catch (\Exception $e){

            return $this->errorResponse;
        }
    }

    /**
     * @return mixed
     */
    public function getAllProductsWithNotFlashSale()
    {
        $productIdsWithFlashSale = $this->flashSaleProductRepository->pluckWhere([], 'product_id');
        $whereNotIn = ['id', $productIdsWithFlashSale];

        return $this->productRepository->getWhereNotIn($whereNotIn);
    }

    /**
     * @param $productId
     * @return mixed
     */
    public function getFlashSaleProduct($productId)
    {
        $where = ['id' => $productId];

        return $this->productRepository->whereFirst($where);
    }

    /**
     * @param $data
     * @return array
     */
    public function storeFlashSaleProduct($data)
    {
        try{
            $preparedData = $this->prepareFlashSaleProductData($data);
            $category = $this->flashSaleProductRepository->create($preparedData);

            return [
                'success' => true,
                'message' => 'Flash Sale has been added.',
                'data' => $category,
                'webResponse' => [
                    'success' => 'Flash Sale has been added.',
                ],
            ];
        }catch (\Exception $e){
            return $this->errorResponse;
        }
    }

    /**
     * @param $data
     * @return array
     * @throws \Exception
     */
    public function prepareFlashSaleProductData($data) {
        $preparedData = [];
        $expireDate = new Carbon($data['expires_at']);
        $preparedData['expires_at'] = date_format($expireDate, 'Y-m-d h:m:s');
        $preparedData['product_id'] = $data['product_id'];
        $preparedData['flash_sale_price'] = $data['flash_sale_price'];

        return $preparedData;
    }

    /**
     * @param $data
     * @return array
     */
    public function updateFlashSale($data)
    {
        try{
            $where = ['id' => $data->id];
            $preparedData = $this->prepareUpdatedFlashSaleData($data);
            $this->flashSaleProductRepository->update($where, $preparedData);

            return [
                'success' => true,
                'message' => 'Flash Sale has been updated.',
                'webResponse' => [
                    'success' => 'Flash Sale has been updated.',
                ],
            ];
        }catch (\Exception $e){
            return $this->errorResponse;
        }
    }

    /**
     * @param $data
     * @return array
     * @throws \Exception
     */
    public function prepareUpdatedFlashSaleData($data) {
        $preparedData = [];
        $expireDate = new Carbon($data['expires_at']);
        $preparedData['expires_at'] = date_format($expireDate, 'Y-m-d h:m:s');
        $preparedData['product_id'] = $data['product_id'];
        $preparedData['flash_sale_price'] = $data['flash_sale_price'];

        return $preparedData;
    }

    /**
     * @param $id
     * @return array
     */
    public function deleteFlashSale($id)
    {
        try{
            $id = decrypt($id);
            $where = ['id' => $id];
            $response = $this->flashSaleProductRepository->deleteWhere($where);

            return [
                'success' => true,
                'message' => 'Flash Sale has been deleted.',
                'webResponse' => [
                    'success' => 'Flash Sale has been deleted.',
                ],
            ];
        }catch (\Exception $e){

            return $this->errorResponse;
        }
    }

    /**
     * @return array|\Illuminate\Http\JsonResponse|mixed
     */
    public function flashSaleListQuery() {
        $flashSaleProducts = $this->flashSaleProductRepository->getAllQuery();
        try {
            return datatables($flashSaleProducts)
                ->addColumn('name', function ($item) {
                    $product = $this->productRepository->getById($item->product_id);

                    return $product['name'];
                })
                ->addColumn('expires_at', function ($item) {
                    return $item->expires_at;
                })
                ->addColumn('flash_sale_price', function ($item) {
                    return $item->flash_sale_price;
                })
                ->addColumn('actions', function ($item) {
                    $generatedData = '<ul class="d-flex justify-content-center activity-menus mb-0">';

                    $generatedData .= '<a class="text-primary" href="';
                    $generatedData .= route('admin.editFlashSale', encrypt($item->id));
                    $generatedData .= '" data-toggle="tooltip" title="Edit">';
                    $generatedData .= '<i class="fa fa-pencil"></i>';
                    $generatedData .= '</a>';

                    $generatedData .= '<a class="ml-3 text-danger" href="';
                    $generatedData .= route('admin.deleteFlashSale', encrypt($item->id));
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
