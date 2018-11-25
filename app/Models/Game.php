<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /////////////////////
    /// Relationships ///
    /////////////////////

    /**
     * Get roles related to the game
     *
     * @access public
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function roles()
    {
        return $this->hasMany('App\Models\Role');
    }

    /**
     * Get game levels related to the game
     *
     * @access public
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gameLevels()
    {
        return $this->hasMany('App\Models\GameLevel');
    }
}
