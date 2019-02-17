<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamOrganisation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'organisation_team';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'team_id',
        'organisation_id',
        'status'
    ];
}
