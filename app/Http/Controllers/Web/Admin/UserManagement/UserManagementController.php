<?php

namespace App\Http\Controllers\Web\Admin\UserManagement;

use App\Http\Requests\Web\UserAddRequest;
use App\Http\Services\UserManagementService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class UserManagementController extends Controller
{

    public $userManagementService;

    /**
     * UserController constructor.
     * @param UserManagementService $userManagementService
     */
    function __construct(UserManagementService $userManagementService)
    {
        $this->userManagementService = $userManagementService;
    }

    /**
     * @param Request $request
     * @return Application|Factory|JsonResponse|View|mixed
     * @throws \Exception
     */
    public function userList(Request $request)
    {
        $data['mainMenu'] = 'userList';
        $data['pageTitle'] = __('User List');

        return view('admin.user_management.list', $data);
    }

    /**
     * @return array
     */
    public function getUserList()
    {
        return $this->userManagementService->getUserList();
    }

    /**
     * @return Application|Factory|View
     */
    public function userAdd()
    {
        $data['mainMenu'] = 'userList';
        $data['buttonTitle'] = __('Add User');
        $data['pageTitle'] = __('Add User');

        return view('admin.user_management.addEdit', $data);
    }

    /**
     * @param $id
     * @return Application|Factory|RedirectResponse|View
     */
    public function userEdit($id)
    {
        $response = $this->userManagementService->userEdit($id);
        if($response['success']){
            return view('admin.user_management.addEdit', $response['data']);
        }
        else{
            return redirect()->back()->with(['error' => $response['message']]);
        }
    }

    /**
     * @param $id
     * @return Application|Factory|RedirectResponse|View
     */
    public function userView($id)
    {
        $response = $this->userManagementService->userView($id);
        if($response['success']){
            return view('admin.user_management.view', $response['data']);
        }
        else{
            return redirect()->back()->with(['error' => $response['message']]);
        }
    }

    /**
     * @param UserAddRequest $request
     * @return RedirectResponse
     */
    public function userAddProcess(UserAddRequest $request)
    {
        $response = $this->userManagementService->userAddProcess($request);
        if($response['success']){
            if ($request->id) {
                return redirect()->route('admin.userView', ['id' => encrypt($request->id)])->with(['success' => $response['message']]);
            }
            else {
                return redirect()->route('admin.userList')->with(['success' => $response['message']]);
            }
        }
        else {
            return redirect()->back()->withInput()->with(['error' => $response['message']]);
        }
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function userDelete($id)
    {
        $response = $this->userManagementService->deleteUser($id);
        if($response['success']){
            return redirect()->back()->with(['success' => $response['message']]);
        }
        else{
            return redirect()->back()->with(['error' => $response['message']]);
        }
    }
}
