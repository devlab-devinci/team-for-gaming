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
     * Get users related to the game
     *
     * @access public
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'game_user');
    }

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
