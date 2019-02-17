<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
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
     * Get teams invitations related to the organisation
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
     * Get teams related to the organisation
     *
     * @access public
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function teams()
    {
        return $this->hasMany('App\Models\TeamOrganisation')->where('status', 1);
    }

    /**
     * Get users related to the organisation
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
