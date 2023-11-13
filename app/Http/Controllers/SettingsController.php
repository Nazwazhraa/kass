<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SettingsController extends Controller
{
    public function profile()
    {
        return view('settings.profile');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function editProfile()
    {
        return view('settings.edit-profile');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        if ($user->photo) {
            $photoPath = public_path('uploads/' . $user->photo);
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
        }

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads'), $photoName);

            // Simpan nama file foto profil baru dalam database
            $user->photo = $photoName;
            $user->save();
        }

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil Memperbarui Profile"
        ]);

        return redirect('profile');
    }

    public function editPassword()
    {
        return view('settings.edit-password');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'password' => 'required|passcheck:' . $user->password,
            'new_password' => 'required|confirmed|min:6',
        ], [
            'password.passcheck' => 'Password lama tidak sesuai'
        ]);
        $user->password = bcrypt($request->get('new_password'));
        $user->save();
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Password berhasil diubah"
        ]);
        return redirect('home');
    }
}
