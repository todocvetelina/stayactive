<?php

namespace App\Models\Boilerplate;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use App\Events\Boilerplate\UserCreated;
use App\Events\Boilerplate\UserDeleted;
use App\Menu\Recipes;
use App\Models\Recipe;
use App\Models\Workout;
use App\Notifications\Boilerplate\NewUser;
use App\Notifications\Boilerplate\ResetPassword;
use App\Notifications\Boilerplate\VerifyEmail;
use Thomaswelton\LaravelGravatar\Facades\Gravatar;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use LaratrustUserTrait;
    use SoftDeletes;

    protected $casts = ['settings' => 'array'];

    protected $fillable = [
        'active',
        'last_name',
        'first_name',
        'email',
        'password',
        'remember_token',
        'last_login',
        'settings',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $dispatchesEvents = [
        'forceDeleted' => UserDeleted::class,
        'created'      => UserCreated::class,
    ];


    public function recipes()
    {
        return $this->belongsToMany(Recipe::class)->withPivot('date');;
    }

    public function workouts()
    {
        return $this->belongsToMany(Workout::class)->withPivot('start_date', 'end_date');
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        if (config('boilerplate.auth.verify_email')) {
            $this->notify(new VerifyEmail());
        }
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    /**
     * Send notification when a new user is created.
     *
     * @param  string  $token
     */
    public function sendNewUserNotification($token)
    {
        $this->notify(new NewUser($token, $this));
    }


    /**
     * Return first name with first char of every word in uppercase.
     *
     * @param $value
     * @return string
     */
    public function getFirstNameAttribute($value)
    {
        return mb_convert_case($value, MB_CASE_TITLE);
    }

    /**
     * Return a concatenation of first name and last_name if field name does not exists.
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->getAttribute('first_name').' '.$this->getAttribute('last_name');
    }

    /**
     * Return last login date formatted.
     *
     * @param  string  $format
     * @param  string  $default
     * @return mixed|string
     */
    public function getLastLogin($format = 'YYYY-MM-DD HH:mm:ss', $default = '')
    {
        if ($this->last_login === null) {
            return $default;
        }

        return Carbon::createFromTimeString($this->last_login)->isoFormat($format);
    }

    /**
     * Return role list as a string.
     *
     * @return string
     */
    public function getRolesList()
    {
        $res = [];
        foreach ($this->roles as $role) {
            $res[] = __($role->display_name);
        }

        return empty($res) ? '-' : implode(', ', $res);
    }

    /**
     * Return true if user has an avatar image.
     *
     * @return bool
     */
    public function hasAvatar()
    {
        return is_file($this->getAvatarPathAttribute());
    }

    /**
     * Check if current user has an avatar.
     *
     * @return string|false
     */
    public function getAvatarPathAttribute()
    {
        return public_path('images/avatars/'.md5($this->id.$this->email).'.jpg');
    }

    /**
     * Delete avatar image.
     *
     * @return bool
     */
    public function deleteAvatar()
    {
        if ($this->hasAvatar()) {
            return unlink($this->getAvatarPathAttribute());
        }

        return false;
    }

    /**
     * Return current user avatar uri.
     *
     * @return string
     */
    public function getAvatarUrlAttribute()
    {
        if (is_file($this->avatar_path)) {
            return asset('images/avatars/'.md5($this->id.$this->email).'.jpg?t='.filemtime($this->avatar_path));
        }

        return 'https://ui-avatars.com/api/?'.http_build_query([
            'background' => 'F0F0F0',
            'color' => '333',
            'size' => 170,
            'name' => $this->getNameAttribute(),
        ]);
    }

    /**
     * Get avatar image from Gravatar.com.
     *
     * @return bool
     */
    public function getAvatarFromGravatar()
    {
        if (! Gravatar::exists($this->getAttribute('email'))) {
            return false;
        }

        if ($this->hasAvatar()) {
            unlink($this->getAvatarPathAttribute());
        }

        $src = Gravatar::src($this->getAttribute('email'), 250);
        $img = file_get_contents($src);
        $destDir = public_path('images/avatars/');

        if (! is_dir($destDir)) {
            mkdir($destDir, 0766, true);
        }

        file_put_contents($this->getAvatarPathAttribute(), $img);

        return true;
    }

    /**
     * Retrieve or store a setting with a given name or fall back to the default.
     *
     * @param  string|array  $name
     * @param  mixed  $default
     * @return mixed|null
     */
    public function setting($name, $default = null)
    {
        if (is_array($name)) {
            $this->settings = array_merge($this->settings ?? [], $name);

            return $this->save();
        }

        $setting = $this->settings[$name] ?? $default;

        if ($setting === 'true') {
            return true;
        }

        if ($setting === 'false') {
            return false;
        }

        return $setting;
    }
}
