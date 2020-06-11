<?php

namespace App\Http\Controllers\Web\Admin\Settings;

use App\Http\Services\SettingsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function settings()
    {
        $data['settings'] = allSetting();
        $data['mainMenu'] = 'settings';
        $data['pageTitle'] = __('Settings');

        return view('admin.settings.general_settings', $data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function settingsSaveProcess(Request $request)
    {
        $service = new SettingsService();
        $response = $service->SaveAdminSettings($request);
        if($response['success']){
            return redirect()->back()->withInput()->with(['success' => $response['message']]);
        }
        else {
            return redirect()->back()->with(['error' => $response['message']])->withInput();
        }
    }
}
