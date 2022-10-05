<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Read extends Model
{
    protected $fillable = [
        'user_id',
        'information_id',
        'created_at',
        'updated_at',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relation Ships
    |--------------------------------------------------------------------------
    */

    /**
     * user
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * information
     *
     * @return void
     */
    public function information()
    {
        return $this->belongsTo('App\Models\Information');
    }
}
