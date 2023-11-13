<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Laratrust\Traits\LaratrustUserTrait;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements LaratrustUser
{
    use HasApiTokens, HasFactory, Notifiable, HasRolesAndPermissions;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_verified' => 'boolean'
    ];

    public function generateVerificationToken()
    {
        $token = $this->verification_token;
        if (!$token) {
            $token = Str::random(40);
            $this->verification_token = $token;
            $this->save();
        }
        return $token;
    }

    public function sendVerification()
    {
        $user = $this;
        $token = $this->generateVerificationToken();
        Mail::send('auth.emails.verification', compact('user', 'token'), function ($m) use ($user) {
            $m->to($user->email, $user->name)->subject('Verifikasi Akun Larapus');
        });
    }
    public function verify()
    {
        $this->is_verified = 1;
        $this->verification_token = null;
        $this->save();
    }
    public function assignRole($roleName)
    {
        $role = Role::where('name', $roleName)->first();

        if ($role) {
            $this->syncRoles([$role]);
        }
    }

    // public function getRolesListAttribute()
    // {
    //     return $this->getRoleNames()->implode(', ');
    // }

}
