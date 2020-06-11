<?php
/**
 * Created by PhpStorm.
 * User: debu
 * Date: 8/9/19
 * Time: 12:21 PM
 */

namespace App\Http\Services;


use App\Http\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class UserManagementService
{
    private $errorMessage;
    private $errorResponse;
    private $userRepository;

    /**
     * UserManagementService constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
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
     * @param $id
     * @return array|RedirectResponse
     */
    public function userEdit($id)
    {
        try {
            $user = $this->userRepository->getById(decrypt($id));
            if (empty($user)) {
                return redirect()->back()->with(['error' => __('User not found')]);
            }
            $user->name = $user->first_name . ' ' . $user->last_name;

            $data['mainMenu'] = 'userList';
            $data['item'] = $user;
            $data['buttonTitle'] = __('Update');
            $data['subMenu'] = 'User Edit';
            $data['menuName'] = __('User List');
            $data['subMenuName'] = __('Update User');
            $data['userId'] = decrypt($id);
            $data['pageTitle'] = __('Update User');

            return [
                'success' => true,
                'message' => '',
                'data' => $data
            ];
        } catch (\Exception $exception) {
            return $this->errorResponse;
        }
    }

    /**
     * @param $id
     * @return array|RedirectResponse
     */
    public function userView($id)
    {
        try {
            $user = $this->userRepository->getById(decrypt($id));
            if (empty($user)) {
                return redirect()->back()->with(['error' => __('User not found')]);
            }
            $user->name = $user->first_name . ' ' . $user->last_name;

            $data['mainMenu'] = 'userList';
            $data['item'] = $user;
            $data['subMenu'] = 'User View';
            $data['menuName'] = __('User List');
            $data['subMenuName'] = __('User View');
            $data['userId'] = decrypt($id);
            $data['pageTitle'] = __('View User');

            return [
                'success' => true,
                'message' => '',
                'data' => $data
            ];
        } catch (\Exception $exception) {
            return $this->errorResponse;
        }
    }

    /**
     * @param $request
     * @return array|RedirectResponse
     */
    public function userAddProcess($request)
    {
        if (!empty($request->email) && !filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return [
                'success' => false,
                'message' => __('Invalid email address'),
                'data' => null
            ];
        }
        $name = explode(' ', $request->name);
        try {
            if ($request->id) {
                $where = [
                    ['phone' , $request->phone],
                    ['id', '!=', $request->id]
                ];
                $hasPhone = $this->userRepository->whereFirst($where);
                if (!empty($hasPhone)) {
                    return [
                        'success' => false,
                        'message' => __('This phone number is already used'),
                        'data' => null
                    ];
                }
                $this->userRepository->update(['id' => $request->id], [
                    'first_name' => isset($name[0]) ? $name[0] : "",
                    'last_name' => isset($name[1]) ? $name[1] : "",
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'zip_code' => $request->zip_code,
                    'city' => $request->city,
                    'country' => $request->country,
                    'status' => $request->status
                ]);

                return [
                    'success' => true,
                    'message' => __('User has been updated successfully'),
                    'data' => null
                ];
            }
            else {
                $where = ['phone' => $request->phone];
                $hasPhone = $this->userRepository->whereFirst($where);
                if (!empty($hasPhone)) {
                    return [
                        'success' => false,
                        'message' => __('This phone number is already used'),
                        'data' => null
                    ];
                }
                $randNum = randomNumber(10);

                $this->userRepository->create([
                    'first_name' => isset($name[0]) ? $name[0] : "",
                    'last_name' => isset($name[1]) ? $name[1] : "",
                    'email' => $request->email,
                    'password' => Hash::make($randNum),
                    'role' => USER_ROLE,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'zip_code' => $request->zip_code,
                    'city' => $request->city,
                    'country' => $request->country,
                    'status' => $request->status
                ]);

                return [
                    'success' => true,
                    'message' => __('User has been added successfully'),
                    'data' => null
                ];
            }
        } catch (\Exception $exception) {
            return $this->errorResponse;
        }
    }

    /**
     * @param $id
     * @return array
     */
    public function deleteUser($id)
    {
        try {
            $id = decrypt($id);
            $this->userRepository->delete($id);
            return [
                'success' => true,
                'message' => __('User has been deleted successfully'),
                'data' => null
            ];
        } catch (\Exception $exception) {
            return [
                'success' => false,
                'message' => __('Something went wrong'),
                'data' => null
            ];
        }
    }

    /**
     * @return array
     */
    public function getUserList()
    {
        $where = [['status', '!=', DELETE_STATUS]];
        $user = $this->userRepository->getWhereQuery($where);
        try {
            return datatables($user)
                ->addColumn('status', function ($item) {
                    return userStatus($item->status);
                })
                ->editColumn('first_name', function ($item) {
                    return $item->first_name . ' ' . $item->last_name;
                })
                ->editColumn('phone', function ($item) {
                    return $item->phone;
                })
                ->addColumn('action', function ($item) {
                    $html = '<ul class="activity-menu list-unstyled" style="display: inline-flex;">
                                <li>
                                    <a class="text-info mr-2" href="' . route('admin.userView', encrypt($item->id)) . '" data-toggle="tooltip" data-placement="top" title="' . __('View') . '">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-danger mr-2 confirmedDelete" href="' . route('admin.userDelete', encrypt($item->id)) . '" data-toggle="tooltip" title="Delete" onclick="return confirm(\'Are you sure to delete this ?\');" data-placement="top" >
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </li>';

                    return $html;
                })
                ->rawColumns(['action'])
                ->make(true);
        } catch (\Exception $e) {
            return [];
        }
    }
}
