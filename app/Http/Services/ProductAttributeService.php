<?php


namespace App\Http\Services;

use App\Http\Repositories\ProductColorRepository;
use App\Http\Repositories\ProductSizeRepository;
use App\Http\Repositories\ProductVariationRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProductAttributeService
{
    private $errorMessage;
    private $errorResponse;
    private $productColorRepository;
    private $productSizeRepository;
    private $productVariationRepository;

    /**
     * ProductService constructor.
     * @param ProductColorRepository $productColorRepository
     * @param ProductSizeRepository $productSizeRepository
     * @param ProductVariationRepository $productVariationRepository
     */
    public function __construct(ProductColorRepository $productColorRepository, ProductSizeRepository $productSizeRepository, ProductVariationRepository $productVariationRepository)
    {
        $this->productColorRepository = $productColorRepository;
        $this->productSizeRepository = $productSizeRepository;
        $this->productVariationRepository = $productVariationRepository;
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
     * @return array
     */
    public function getProductColors($productId)
    {
        try{
            $productId = decrypt($productId);
            $where = ['product_id' => $productId];
            $colors = $this->productColorRepository->getWhere($where);

            return [
                'success' => true,
                'data' => $colors
            ];
        }catch (\Exception $e){
            return $this->errorResponse;
        }
    }

    /**
     * @param $productId
     * @return array
     */
    public function getProductSizes($productId)
    {
        try{
            $productId = decrypt($productId);
            $where = ['product_id'=> $productId];
            $sizes = $this->productSizeRepository->getWhere($where);

            return [
                'success' => true,
                'data' => $sizes
            ];
        }catch (\Exception $e){
            return $this->errorResponse;
        }
    }

    /**
     * @param $data
     * @return array
     */
    public function updateProductAttributes($data)
    {
        try{
            DB::beginTransaction();
            $deletedColors = $this->deleteRemovedColors($data);
            $deletedSizes = $this->deleteRemovedSizes($data);
            $where = ['product_id' => $data['product_id']];
            $existingColors = $this->productColorRepository->getWhere($where);
            $existingSizes = $this->productSizeRepository->getWhere($where);
            $preparedColorData = $this->prepareProductColorData($data);
            $preparedSizeData = $this->prepareProductSizeData($data);
            $this->productColorRepository->insert($preparedColorData);
            $this->productSizeRepository->insert($preparedSizeData);
            $this->deleteVariationsFor($data, $deletedColors, $deletedSizes);
            $preparedVariationsData = $this->prepareVariationsData($data, $existingColors, $existingSizes, $preparedColorData, $preparedSizeData);
            $this->productVariationRepository->insert($preparedVariationsData);

            DB::commit();

            return [
                'success' => true,
                'message' => 'Attributes have been updated.',
                'webResponse' => [
                    'success' => 'Attributes have been updated.',
                ],
            ];
        }catch (\Exception $e){
            DB::rollBack();

            return $this->errorResponse;
        }
    }

    /**
     * @param $data
     * @return array
     */
    public function deleteRemovedColors($data)
    {
        try{
            $deletedColors = [];
            $colors = $data['colors'];
            $where = ['product_id' => $data['product_id']];
            $productColors = $this->productColorRepository->getWhere($where);
            foreach ($productColors as $productColor) {
                $deleteColor = true;
                foreach ($colors as $color) {
                    if ($productColor->color == $color) {
                        $deleteColor = false;
                        break;
                    }
                }
                if ($deleteColor) {
                    $where = ['id' => $productColor->id];
                    $this->productColorRepository->deleteWhere($where);
                    array_push($deletedColors, $productColor['color']);
                }
            }

            return $deletedColors;
        }catch (\Exception $e){
            return $this->errorResponse;
        }
    }

    /**
     * @param $data
     * @return array
     */
    public function prepareProductColorData($data)
    {
        $preparedData = [];
        $colors = $data['colors'];
        $where = ['product_id' => $data['product_id']];
        $productColors = $this->productColorRepository->getWhere($where);
        foreach ($colors as $color){
            $newColor = true;
            foreach ($productColors as $productColor) {
                if ($productColor->color == $color) {
                    $newColor = false;
                    break;
                }
            }
            if ($newColor) {
                array_push($preparedData, [
                    'product_id' => $data['product_id'],
                    'color' => $color,
                    'created_at' => Carbon::now(),
                ]);
            }
        }

        return $preparedData;
    }

    /**
     * @param $data
     * @return array
     */
    public function deleteRemovedSizes($data)
    {
        try{
            $deletedSizes = [];
            $sizes =  $data['sizes'];
            $where = ['product_id' => $data['product_id']];
            $productSizes = $this->productSizeRepository->getWhere($where);
            foreach ($productSizes as $productSize) {
                $deleteSize = true;
                foreach ($sizes as $size) {
                    if ($productSize->size == $size) {
                        $deleteSize = false;
                        break;
                    }
                }
                if ($deleteSize) {
                    $where = ['id' => $productSize->id];
                    $this->productSizeRepository->deleteWhere($where);
                    array_push($deletedSizes, $productSize['size']);
                }
            }

            return $deletedSizes;
        }catch (\Exception $e){
            return $this->errorResponse;
        }
    }

    /**
     * @param $data
     * @return array
     */
    public function prepareProductSizeData($data)
    {
        $preparedData = [];
        $sizes = $data['sizes'];
        $where = ['product_id' => $data['product_id']];
        $productSizes = $this->productSizeRepository->getWhere($where);
        foreach ($sizes as $size){
            $newSize = true;
            foreach ($productSizes as $productSize) {
                if ($productSize->size == $size) {
                    $newSize = false;
                    break;
                }
            }
            if ($newSize) {
                array_push($preparedData, [
                    'product_id' => $data['product_id'],
                    'size' => $size,
                    'created_at' => Carbon::now(),
                ]);
            }
        }

        return $preparedData;
    }

    /**
     * @param $data
     * @param $deletedColors
     * @param $deletedSizes
     * @return array
     */
    public function deleteVariationsFor($data, $deletedColors, $deletedSizes)
    {
        try{
            $where = ['product_id' => $data['product_id']];
            $productVariations = $this->productVariationRepository->getWhere($where);
            foreach ($productVariations as $productVariation){
                $name = explode('-', $productVariation->name);
                $oldVariation = false;
                foreach ($deletedColors as $key => $deletedColor){
                    if($deletedColor == $name[0]){
                        $oldVariation = true;
                        break;
                    }
                }
                foreach ($deletedSizes as $key => $deletedSize){
                    if($deletedSize == $name[1] || $oldVariation){
                        $oldVariation = true;
                        break;
                    }
                }
                if($oldVariation){
                    $where = ['id'=> $productVariation->id];
                    $this->productVariationRepository->deleteWhere($where);
                }
            }

        }catch (\Exception $e){
            return $this->errorResponse;
        }
    }

    /**
     * @param $data
     * @param $existingColors
     * @param $existingSizes
     * @param $newColors
     * @param $newSizes
     * @return array
     */
    public function prepareVariationsData($data, $existingColors, $existingSizes, $newColors, $newSizes)
    {
        $preparedData = [];
        foreach ($newColors as $color){
            foreach ($existingSizes as $size){
                $variationData = [
                    'product_id' => $data['product_id'],
                    'name' => $color['color'] . '-' . $size['size']
                ];
                array_push($preparedData, $variationData);
            }
        }
        foreach ($newSizes as $size){
            foreach ($existingColors as $color){
                $variationData = [
                    'product_id' => $data['product_id'],
                    'name' => $color['color'] . '-' . $size['size']
                ];
                array_push($preparedData, $variationData);
            }
        }
        foreach ($newSizes as $size){
            foreach ($newColors as $color){
                $variationData = [
                    'product_id' => $data['product_id'],
                    'name' => $color['color'] . '-' . $size['size']
                ];
                array_push($preparedData, $variationData);
            }
        }

        return $preparedData;
    }
}
