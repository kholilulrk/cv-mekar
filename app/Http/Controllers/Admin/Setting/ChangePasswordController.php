<?php

namespace App\Http\Controllers\Admin\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function index ()
    {
        return view('admin.setting.password');
    }

    public function store (Request $request)
    {
        $request->validate([
            'old_password' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (Hash::check($request->old_password, Auth::user()->getAuthPassword())) {
            if (Auth::user()->update(['password' => bcrypt($request->password)])) {
                return redirect()->route('admin.password.index')->with(['status' => 'success', 'message' => 'Update Successfully']);
            }
        }

        return redirect()->route('admin.password.index')->with(['status' => 'danger', 'message' => 'Update Failed, Contact Developer']);
    }
}
