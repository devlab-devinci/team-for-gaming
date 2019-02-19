<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'game_id',
        'name'
    ];

    /////////////////////
    /// Relationships ///
    /////////////////////

    /**
     * Get organisations invitations related to the team
     *
     * @access public
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function invitations()
    {
        return $this->hasMany('App\Models\TeamOrganisation')->where('status', 0);
    }

    /**
     * Get organisation related to the team
     *
     * @access public
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function organisation()
    {
        return $this->hasMany('App\Models\TeamOrganisation')->where('status', 1);
    }

    /**
     * Get game related to the game level
     *
     * @access public
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function game()
    {
        return $this->belongsTo('App\Models\Game');
    }

    /**
     * Get users related to the team
     *
     * @access public
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\Models\UserRole');
    }
}
