<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        if (auth()->attempt($request->only('email', 'password'))) {
            $userAdmin = User::whereEmail($request->email)->whereIsAdmin(1)->first();
            if ($userAdmin) {
                Alert::success($userAdmin->name, 'You Are Success Login Today!');
                return redirect(route('admin.dashboard'));
            } else {
                $userCustomer = User::whereEmail($request->email)->whereIsAdmin(0)->first();
                Alert::success($userCustomer->name, 'Welcome To FoodTime Choose The Menu You Will Eat! ');
                return redirect(route('customers.purchase'));
            }
        } else {
            Alert::error($request->email, 'Email or password you have input wrong!');
            return redirect()->back();
        }
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'retype_password' => 'required|same:password',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'is_admin' => 0,
            'password' => bcrypt($request->password)
        ]);
        Alert::success($request->name, 'Your account has been created, please login!');
        return redirect(route('auth.login'));
    }

    public function user_update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'is_admin' => 'required',
            'email' => 'required',
        ]);
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'is_admin' => $request->is_admin
        ]);
        Alert::success($user->name, 'Account has been updated!');
        return redirect(route('admin.dashboard'));
    }
}
