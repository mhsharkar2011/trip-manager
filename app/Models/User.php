<?php

namespace App\Models;

use App\Devpanel\Models\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Validation\Rule;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    // use InteractsWithMedia;
    use FilterTrait;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name'
        ,'last_name'
        ,'email'
        ,'password'
        ,'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    const ROLE_SUPER_ADMIN = 'superadmin';

    public static function validation_rules()
    {
        return [
            'first_name' => 'required'
            ,'last_name' => 'required'
            ,'email' => 'required|email|unique:users,email'
            ,'password' => 'required'
            ,'role' => 'required'
        ];
    }

    public static function validation_messages()
    {
        return [];
    }

    public static function validation_rules_for_update($user_id)
    {
        $rules = static::validation_rules();

        $rules['email'] = [
            'required',
            'email',
            Rule::unique('users')->ignore($user_id),
        ];

        unset($rules['password']);

        return $rules;
    }

    public static function validation_messages_for_update()
    {
        return static::validation_messages();
    }

    public function scopeSuperAdmin($query) {
        return $query->where('role', self::ROLE_SUPER_ADMIN);
    }
    
    public function scopeNonSuperAdmin($query) {
        return $query
        ->where('role', '!=', self::ROLE_SUPER_ADMIN)
        ->orWhereNull('role');
    }

    public static function getSuperAdmin($attr = null) {
        $u = self::superAdmin()->first();

        return $attr? optional($u)->{$attr} : $u;
    }

    public static function superAdminExists($attr = null) {
        return self::superAdmin()->exists();
    }

}
