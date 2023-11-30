<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AccountController extends Controller
{
    public function index()
    {
        return view('admin.account.index');
    }

    public function updatePassword(Request $request)
    {
        # Validation
        $request->validate([
            'currentPassword' => 'required',
            'newPassword' => [
                'required',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ],
            'confirmPassword' => 'required|same:newPassword',
        ]);


        #Match The Old Password
        if (!Hash::check($request->currentPassword, auth()->user()->password)) {
            return back()->with("error", "Password tidak sesuai!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->newPassword)
        ]);

        Auth::logout();
        Auth::logoutOtherDevices($request->currentPassword);

        return redirect()->route('login');
    }
}
