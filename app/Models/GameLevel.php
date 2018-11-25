<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameLevel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'game_level';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'game_id',
        'label',
        'order'
    ];

    /////////////////////
    /// Relationships ///
    /////////////////////

    /**
     * Get game related to the game level
     *
     * @access public
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gameLevels()
    {
        return $this->belongsTo('App\Models\Game');
    }
}
