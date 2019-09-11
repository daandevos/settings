<?php
declare(strict_types=1);

namespace App;

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
}
