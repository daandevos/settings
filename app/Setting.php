<?php
declare(strict_types=1);

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get the category that owns the setting.
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * The users that belong to the setting.
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    /**
     * Get the setting value for the specified user.
     *
     * @param \App\User  $user
     * @return null|int
     */
    public function getValueForUser(User $user): ?int
    {
        $setting = $user->settings()->find($this->id);

        return !empty($setting) ? optional($setting->pivot)->value : null;
    }
}
