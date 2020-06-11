<?php


namespace App\Http\Services;

use App\Http\Repositories\ProductVariationImageRepository;
use App\Http\Repositories\ProductVariationRepository;

class ProductVariationService
{
    private $errorMessage;
    private $errorResponse;
    private $productVariationRepository;
    private $productVariationImageRepository;

    /**
     * ProductService constructor.
     * @param ProductVariationRepository $productVariationRepository
     * @param ProductVariationImageRepository $productVariationImageRepository
     */
    public function __construct(ProductVariationRepository $productVariationRepository, ProductVariationImageRepository $productVariationImageRepository)
    {
        $this->productVariationRepository = $productVariationRepository;
        $this->productVariationImageRepository = $productVariationImageRepository;
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
     * @param $productId
     * @return mixed
     */
    public function productVariations($productId)
    {
        try {
            $productId = decrypt($productId);
            $where = ['product_id' => $productId];
            $productVariations = $this->productVariationRepository->getWhere($where);
            return [
                'success' => true,
                'message' => 'Variations',
                'data' => $productVariations,
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
    public function updateProductVariations($data)
    {
        try {
            $preparedProductVariationData = $this->prepareProductVariationData($data);

            foreach ($preparedProductVariationData as $key => $productVariationData){
                $where = [
                    'product_id' => $data['product_id'],
                    'id' => $data['product_variation_id'][$key]
                ];
                $this->productVariationRepository->update($where, $productVariationData);
            }

            return [
                'success' => true,
                'message' => 'Variations have been updated',
                'webResponse' => [
                    'success' => 'Variations have been updated',
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
    public function prepareProductVariationData($data)
    {
        $preparedData = [];
        foreach ($data['product_variation_id']  as $key => $id){
            $productVariation = [
                'price' => $data['price'][$key],
                'quantity' => $data['quantity'][$key],
            ];
            array_push($preparedData, $productVariation);
        }

        return $preparedData;
    }

    /**
     * @param $productId
     * @return array
     */
    public function productVariationsWithImages($productId)
    {
        try {
            $productId = decrypt($productId);
            $where = ['product_id' => $productId];
            $productVariations = $this->productVariationRepository->getWhere($where);
            foreach ($productVariations as $productVariation){
                $where = ['product_variation_id' => $productVariation->id];
                $image = $this->productVariationImageRepository->whereFirst($where);
                $productVariation['image'] = $image['image'];
            }

            return [
                'success' => true,
                'message' => 'Variations',
                'data' => $productVariations,
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
    public function updateProductVariationImages($data)
    {
        try {
            $preparedProductVariationImages = $this->prepareProductVariationImageData($data);
            foreach ($preparedProductVariationImages as $key => $productVariationImage){
                $where = ['product_variation_id' => $data['product_variation_ids'][$key]];
                $this->productVariationImageRepository->updateOrCreate($where, $productVariationImage);
            }

            return [
                'success' => true,
                'message' => 'Variations have been updated',
                'webResponse' => [
                    'success' => 'Variations have been updated',
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
    public function prepareProductVariationImageData($data)
    {
        $preparedData = [];
        foreach ($data['product_variation_ids'] as $key => $product_variation_id){

            if(isset($data['images'][$key])){
                $where = ['product_variation_id' => $product_variation_id];
                $oldImage = $this->productVariationImageRepository->whereFirst($where);
                $newImage = uploadFile($data['images'][$key], productImagePath(), $oldImage['image']);
                $preparedData[$key] = ['image' => $newImage];
            }
        }

        return $preparedData;

    }
}
