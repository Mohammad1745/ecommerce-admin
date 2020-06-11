<?php


namespace App\Http\Services;


use App\Http\Repositories\ShippingMethodRepository;

class ShippingMethodService
{
    private $errorMessage;
    private $errorResponse;
    private $shippingMethodRepository;

    /**
     * ShippingMethodService constructor.
     * @param ShippingMethodRepository $repository
     */
    public function __construct(ShippingMethodRepository $repository)
    {
        $this->shippingMethodRepository = $repository;
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
    public function getAllCategories()
    {
        $orderBy = ['id', 'desc'];
        return $this->shippingMethodRepository->getAll($orderBy);
    }

    /**
     * @param $id
     * @return array
     */
    public function getShippingMethodById($id)
    {
        try{
            $id = decrypt($id);
            $shippingMethod = $this->shippingMethodRepository->getById($id);

            return [
                'success' => true,
                'message' => 'Shipping Method has been found.',
                'data' => $shippingMethod,
                'webResponse' => [
                    'success' => 'Shipping Method has been found.',
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
    public function storeShippingMethod($data)
    {
        try{
            $preparedData['name'] = $data['name'];
            $shippingMethod = $this->shippingMethodRepository->create($preparedData);

            return [
                'success' => true,
                'message' => 'Shipping Method has been added.',
                'data' => $shippingMethod,
                'webResponse' => [
                    'success' => 'Shipping Method has been added.',
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
    public function updateShippingMethod($data)
    {
        try{
            $where = ['id' => $data->id];
            $preparedData['name'] = $data['name'];
            $this->shippingMethodRepository->update($where, $preparedData);

            return [
                'success' => true,
                'message' => 'Shipping Method has been updated.',
                'webResponse' => [
                    'success' => 'Shipping Method has been updated.',
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
    public function deleteShippingMethod($id)
    {
        try{
            $id = decrypt($id);
            $where = ['id' => $id];
            $response = $this->shippingMethodRepository->deleteWhere($where);

            return [
                'success' => true,
                'message' => 'Shipping Method has been deleted.',
                'webResponse' => [
                    'success' => 'Shipping Method has been deleted.',
                ],
            ];
        }catch (\Exception $e){

            return $this->errorResponse;
        }
    }

    /**
     * @return array|\Illuminate\Http\JsonResponse|mixed
     */
    public function shippingMethodListQuery() {
        $categories = $this->shippingMethodRepository->getAllQuery();
        try {
            return datatables($categories)
                ->editColumn('name', function ($item) {
                    return $item->name;
                })
                ->addColumn('actions', function ($item) {
                    $generatedData = '<ul class="d-flex justify-content-center activity-menus mb-0">';

                    $generatedData .= '<a class="text-primary" href="';
                    $generatedData .= route('admin.editShippingMethod', encrypt($item->id));
                    $generatedData .= '" data-toggle="tooltip" title="Edit">';
                    $generatedData .= '<i class="fa fa-pencil"></i>';
                    $generatedData .= '</a>';

                    $generatedData .= '<a class="ml-3 text-danger" href="';
                    $generatedData .= route('admin.deleteShippingMethod', encrypt($item->id));
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
