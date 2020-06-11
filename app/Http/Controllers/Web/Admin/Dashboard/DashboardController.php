<?php

namespace App\Http\Controllers\Web\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Services\DashboardService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class DashboardController extends Controller
{
    private $dashboardService;

    /**
     * DashboardController constructor.
     * @param DashboardService $dashboardService
     */
    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    /**
     * @return Application|Factory|View
     */
    public function dashboard()
    {
        $response = $this->dashboardService->dashboard();
        if($response['success']) {
            $data = $response['data'];
            $data['mainMenu'] = 'dashboard';
            $data['pageTitle'] = __('Dashboard');

            return view('admin.dashboard', $data);
        }
    }
}
