<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Users;
use App\Levels;

use App\Enums\PermissionsEnum;

class UsersAdminController extends Controller
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

    protected function validator(array $data)
    {
        $validator =  Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255']
        ]);

        if($validator->fails()) {
            return $validator->errors();
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!PermissionsAdminController::hasPermission(PermissionsEnum::ENABLE_ADMIN_USERS_MENU)) {
            return redirect()->route('admin/home');
        }
        $levels = Levels::all();
        $users = Users::all();
        foreach ($users as $user) {
            $user->level_id = $levels->where('id', $user->level_id)->first();
        }
        $settings_array = $this->get_settings_variables();
        return view('admin.content.users')->with([
            "users" => $users,
            'page_name' => $settings_array['page_name']
        ]);
    }

    public function geUsertDetails($id) {
        $user = Users::find($id);
        if (empty($user)) {
            return response()->json(['errors' => 'Not find user']);
        } else {
            return response()->json(['user' => $user]);
        }
    }

    protected function update(Request $request) {
        $errors = $this->validator($request->all());
        if ( $errors) {
            return response()->json(['errors'=>$errors]);
        } else {
            $user = Users::find($request->id);
            $user->name = $request->name;
            $user->bornDate = $request->bornDate;
            $user->sex = $request->sex;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->telephone = $request->telephone;
            $user->save();

            return response()->json(['success'=>$user]);
        }
    }

     protected function remove($userId) {
         if (is_null ($userId)) {
            return response()->json(['errors'=>'Nem létezik ilyen felhasználó']);
         } else {
            $user = Users::find($userId);
            return response()->json(['success'=>$user->delete()]);
         }
    }

}
