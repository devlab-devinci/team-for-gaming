<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameLevel extends Model
{
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
    public function game()
    {
        return $this->belongsTo('App\Models\Game');
    }
}
