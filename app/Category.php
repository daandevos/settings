<?php
declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
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
     * Get the settings for the category.
     */
    public function settings()
    {
        return $this->hasMany('App\Setting');
    }

    /**
     * Get the children for the category.
     */
    public function children()
    {
        return $this->hasMany('App\Category', 'parent_id');
    }
}
