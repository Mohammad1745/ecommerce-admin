<?php


namespace App\Http\Controllers\Web\Admin\Category;


use App\Http\Controllers\Controller;
use App\Http\Requests\Web\CategoryStoreRequest;
use App\Http\Requests\Web\CategoryUpdateRequest;
use App\Http\Services\CategoryService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    private $categoryService;

    /**
     * CategoryService constructor.
     * @param CategoryService $service
     */
    public function __construct(CategoryService $service)
    {
        $this->categoryService = $service;
    }

    /**
     * @return Application|Factory|View
     */
    public function  categoryList()
    {
        $data['mainMenu'] = 'category';
        $data['pageTitle'] = __('Category List');

        return view('admin.category.list', $data);
    }

    /**
     * @return array|JsonResponse|mixed
     */
    public function  getCategoryList()
    {
        return $this->categoryService->categoryListQuery();
    }

    /**
     * @return Application|Factory|View
     */
    public function  createCategory()
    {
        $data['mainMenu'] = 'category';
        $data['pageTitle'] = __('Create Category');
        $data['parentCategories'] = $this->categoryService->getAllCategories();

        return view('admin.category.create', $data);
    }

    /**
     * @param CategoryStoreRequest $request
     * @return RedirectResponse
     */
    public function  storeCategory(CategoryStoreRequest $request)
    {
        $response = $this->categoryService->storeCategory($request);

        return $response['success'] ?
            redirect()->route('admin.categoryList')->with($response['webResponse']) :
            redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param $id
     * @return Application|Factory|RedirectResponse|View
     */
    public function  editCategory($id)
    {
        $data['mainMenu'] = 'category';
        $data['pageTitle'] = __('Edit Category');
        $data['parentCategories'] = $this->categoryService->getAllCategories();
        $response = $this->categoryService->getCategoryById($id);
        if($response['success']){
            $data['category'] = $response['data'];

            return view('admin.category.edit', $data);
        }
        return redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param CategoryUpdateRequest $request
     * @return RedirectResponse
     */
    public function  updateCategory(CategoryUpdateRequest $request)
    {
        $response = $this->categoryService->updateCategory($request);

        return $response['success'] ?
            redirect()->route('admin.categoryList')->with($response['webResponse']) :
            redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function  deleteCategory($id)
    {
        $response = $this->categoryService->deleteCategory($id);

        return $response['success'] ?
            redirect()->route('admin.categoryList')->with($response['webResponse']) :
            redirect()->back()->with($response['webResponse']);
    }
}
