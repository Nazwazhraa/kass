<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('user-should-verified');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'g-recaptcha-response' => 'required|captcha',
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $memberRole = Role::where('name', 'member')->first();
        $user->addRole($memberRole);
        $user->sendVerification();
        return $user;
    }

    public function verify(Request $request, $token)
    {
        $email = $request->get('email');
        $user = User::where('verification_token', $token)->where('email', $email)->first();
        if ($user) {
            $user->verify();
            Session::flash("flash_notification", [
                "level" => "success",
                "message" => "Berhasil melakukan verifikasi."
            ]);
            Auth::login($user);
        }
        return redirect('/');
    }

    public function sendVerification(Request $request)
    {
        $user = User::where('email', $request->get('email'))->first();
        if ($user && !$user->is_verified) {
            $user->sendVerification();
            Session::flash("flash_notification", [
                "level" => "success",
                "message" => "Silahkan klik pada link aktivasi yang telah kami kirim."
            ]);
        }
        return redirect('/login');
    }
}
