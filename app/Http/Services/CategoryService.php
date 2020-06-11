<?php


namespace App\Http\Services;


use App\Http\Repositories\CategoryRepository;

class CategoryService
{
    private $errorMessage;
    private $errorResponse;
    private $categoryRepository;

    /**
     * CategoryService constructor.
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->categoryRepository = $repository;
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
        return $this->categoryRepository->getAll($orderBy);
    }

    /**
     * @param $id
     * @return array
     */
    public function getCategoryById($id)
    {
        try{
            $id = decrypt($id);
            $category = $this->categoryRepository->getById($id);

            return [
                'success' => true,
                'message' => 'Category has been found.',
                'data' => $category,
                'webResponse' => [
                    'success' => 'Category has been found.',
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
    public function storeCategory($data)
    {
        try{
            $preparedData = $this->prepareCategoryData($data);
            $category = $this->categoryRepository->create($preparedData);

            return [
                'success' => true,
                'message' => 'Category has been added.',
                'data' => $category,
                'webResponse' => [
                    'success' => 'Category has been added.',
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
    public function prepareCategoryData($data) {
        $preparedData = [];
        $preparedData['name'] = $data['name'];
        $preparedData['description'] = $data['description'];
        $preparedData['parent_id'] = isset($data['parent_id']) ? $data['parent_id'] : null;
        $preparedData['image'] = isset($data['image']) ? uploadFile($data['image'], categoryImagePath()) : null;

        return $preparedData;
    }

    /**
     * @param $data
     * @return array
     */
    public function updateCategory($data)
    {
        try{
            $where = ['id' => $data->id];
            $preparedData = $this->prepareUpdatedCategoryData($data);
            $this->categoryRepository->update($where, $preparedData);

            return [
                'success' => true,
                'message' => 'Category has been updated.',
                'webResponse' => [
                    'success' => 'Category has been updated.',
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
    public function prepareUpdatedCategoryData($data) {
        $preparedData = [];
        $preparedData['name'] = $data['name'];
        $preparedData['description'] = $data['description'];
        $preparedData['parent_id'] = isset($data['parent_id']) ? $data['parent_id'] : null;
        $oldImage = $this->categoryRepository->getById($data['id'])->image;
        if(isset($data['image'])){
            $preparedData['image'] = uploadFile($data['image'], categoryImagePath(), $oldImage);
        }

        return $preparedData;
    }

    /**
     * @param $id
     * @return array
     */
    public function deleteCategory($id)
    {
        try{
            $id = decrypt($id);
            $where = ['id' => $id];
            $response = $this->categoryRepository->deleteWhere($where);

            return [
                'success' => true,
                'message' => 'Category has been deleted.',
                'webResponse' => [
                    'success' => 'Category has been deleted.',
                ],
            ];
        }catch (\Exception $e){

            return $this->errorResponse;
        }
    }

    /**
     * @return array|\Illuminate\Http\JsonResponse|mixed
     */
    public function categoryListQuery() {
        $categories = $this->categoryRepository->getAllQuery();
        try {
            return datatables($categories)
                ->editColumn('name', function ($item) {
                    return $item->name;
                })
                ->editColumn('description', function ($item) {
                    return $item->description;
                })
                ->addColumn('parent_category', function ($item) {
                    $parentCategory = $this->categoryRepository->getById($item->parent_id);

                    return $parentCategory['name'];
                })
                ->addColumn('actions', function ($item) {
                    $generatedData = '<ul class="d-flex justify-content-center activity-menus mb-0">';

                    $generatedData .= '<a class="text-primary" href="';
                    $generatedData .= route('admin.editCategory', encrypt($item->id));
                    $generatedData .= '" data-toggle="tooltip" title="Edit">';
                    $generatedData .= '<i class="fa fa-pencil"></i>';
                    $generatedData .= '</a>';

                    $generatedData .= '<a class="ml-3 text-danger" href="';
                    $generatedData .= route('admin.deleteCategory', encrypt($item->id));
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
