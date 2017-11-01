<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repository extends Model
{
    protected $fillable =[
      'name', 'description', 'scientificName', 'latitude', 'longitude'
    ];

    /**
     * Get the photos associated with the given Repository
     */
    public function photos()
    {
        return $this->belongsToMany(Photo::class);
    }
}
