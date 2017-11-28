<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discovery extends Model
{
    protected $fillable = [
        'title', 'description','latitude','altitude','longitude'
    ];
    public function repositories()
    {
        return $this->belongsToMany(Repository::class);
    }
    /**
     * Get the photos associated with the given Repository
     */
    public function photos()
    {
        return $this->belongsToMany(Photo::class);
    }
}
