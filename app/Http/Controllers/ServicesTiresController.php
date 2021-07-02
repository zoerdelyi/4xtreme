<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServicesTires;
use App\BookingsServicesTires;
use App\Http\Controllers\Admin\PermissionsAdminController;
use App\Enums\PermissionsEnum;
use Illuminate\Support\Facades\Validator;

class ServicesTiresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function validator(array $data)
    {
        $validator =  Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            // 'grossPrice' => ['required', 'numeric', 'digits_between:1,10']
            // 'netPrice' => ['required ', 'numeric', 'digits_between: 1,10']
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }
    }

    public function getAllServices()
    {
        return ServicesTires::all();
    }

    protected function remove($id)
    {
        $service = ServicesTires::find($id);
        if (empty($service)) {
            return response()->json(['errors' => "Nem található ilyen szolgáltatás"]);
        } else {
            $exist_booking = BookingsServicesTires::where('service_id', $id)->first();
            if($exist_booking){
                // nem törölhető a szolgáltatás, mert már épül rá foglalás! MAX átnevezhető!!
                return response()->json(['errors' => 'Nem törölhető a szolgáltatás, mert már épül rá foglalás. A szolgáltatás, csak átnevezhető!']);
            }
            else{
                // törölhető a szolgáltatás
                $service->delete();
                return response()->json(['success' => $service]);
            }
        }
    }

    protected function update(Request $request)
    {
        if (!PermissionsAdminController::hasPermission(PermissionsEnum::ENABLE_ADMIN_SERVICES_MENU)) {
            return redirect()->route('admin/home');
        }

        $errors = $this->validator($request->all());
        if ($errors) {
            return response()->json(['errors' => $errors]);
        } else {
            $service = ServicesTires::find($request->id);
            $service->name = $request->name;
            // $service->gross_price = $request->grossPrice;
            // $service->net_price = $request->netPrice;
            $service->save();

            return response()->json(['success' => $service]);
        }
    }

    protected function insert(Request $request)
    {
        if (!PermissionsAdminController::hasPermission(PermissionsEnum::ENABLE_ADMIN_SERVICES_MENU)) {
            return redirect()->route('admin/home');
        }

        $errors = $this->validator($request->all());
        if ($errors) {
            return response()->json(['errors' => $errors]);
        } else {
            $service = ServicesTires::firstOrNew(array('name' => $request->name));
            $service->name = $request->name;
            // $service->gross_price = $request->grossPrice;
            // $service->net_price = 0;
            $service->save();

            return response()->json(['success' => $service]);
        }
    }
}
