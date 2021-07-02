<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Levels;
use App\Permissions;
use App\LevelsPermissions;

use App\Enums\PermissionsEnum;

class PermissionsAdminController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!PermissionsAdminController::hasPermission(PermissionsEnum::ENABLE_ADMIN_PERMISSIONS_MENU)) {
            return redirect()->route('admin/home');
        }

        $permissions = Permissions::all();
        $levels = Levels::all();
        $permissionLevels = [];

        foreach ($permissions as $permissionId => $permission) {
            $permissionObject = (object) array();
            $permissionObject->id = $permission->id;
            $permissionObject->name = $permission->name;

            $levelArray = array();
            foreach ($levels as $levelId => $level) {
                $levelObject = (object) array();
                $levelObject->id = $level->id;
                $levelObject->checked = LevelsPermissions::where(['permission_id'=>$permission->id, 'level_id'=>$level->id])->exists();
                array_push($levelArray, $levelObject);
            }
            $permissionObject->levelArray = $levelArray;
            array_push($permissionLevels, $permissionObject);
        }

        $settings_array = $this->get_settings_variables();
        return view('admin.content.permissions')->with([
            'levels' => $levels,
            'permissions' => $permissionLevels,
            'page_name' => $settings_array['page_name']
        ]);
    }

    protected function update(Request $request)
    {
        $permissionLevelJson = $request->all();
        $permissionId = $permissionLevelJson["permissionId"];
        $levelId = $permissionLevelJson["levelId"];
        $isSetting = $permissionLevelJson["isSetting"];

        if ($isSetting == 'true') {
             $levelsPermissions = LevelsPermissions::firstOrCreate([
                'level_id' => $levelId,
                'permission_id' => $permissionId
            ]);
            return response()->json(['success'=> 'saved']);
        } else {
            $levelsPermissions = LevelsPermissions::where(['permission_id'=>$permissionId, 'level_id'=>$levelId]);
            $levelsPermissions->delete();
            return response()->json(['success'=> 'deleted']);
        }

    }

    public static function hasPermission($permissionMachineName)
    {
        $permission = Permissions::where(['machine_name'=>$permissionMachineName])->first();
        $hasPermission = LevelsPermissions::where(['level_id'=>\Auth::user()->level_id, 'permission_id'=>$permission->id])->first();
        if (is_null($hasPermission)) {
            return false;
        } else {
            return true;
        }
    }
}
