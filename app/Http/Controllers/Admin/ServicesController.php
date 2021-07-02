<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Services;

use App\Enums\PermissionsEnum;
use App\Http\Controllers\ServicesCarsController;
use App\Http\Controllers\ServicesTiresController;

class ServicesController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        if (!PermissionsAdminController::hasPermission(PermissionsEnum::ENABLE_ADMIN_SERVICES_MENU)) {
            return redirect()->route('admin/home');
        }

        $servicesCarsController = new ServicesCarsController;
        $carServices = $servicesCarsController->getAllServices();

        $servicesTiresController = new ServicesTiresController;
        $tireServices = $servicesTiresController->getAllServices();

        $settings_array = $this->get_settings_variables();
        return view('admin/content/services')->with([
            'carServices' => $carServices,
            'tireServices' => $tireServices,
            'page_name' => $settings_array['page_name']
        ]);
    }

    protected function getListByType($type)
    {
        // if (!PermissionsAdminController::hasPermission(PermissionsEnum::ENABLE_ADMIN_SERVICES_MENU)) {
        //     return redirect()->route('admin/home');
        // }

        if ($type == "car") {
            $servicesCarsController = new ServicesCarsController;
            $services = $servicesCarsController->getAllServices();
        } else if ($type == "tire") {
            $servicesTiresController = new ServicesTiresController;
            $services = $servicesTiresController->getAllServices();
        }

        return response()->json(['services' => $services]);
    }
}
