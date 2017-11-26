<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repository extends Model
{
    protected $fillable =[
      'name', 'description', 'scientificName', 'latitude', 'longitude', 'altitude'
    ];

    /**
     * Get the photos associated with the given Repository
     */
    public function photos()
    {
        return $this->belongsToMany(Photo::class);
    }
    /**
     * Get the disovery associated with the given Repository
     */
    public function discoveries()
    {
        return $this->belongsToMany(Discovery::class);
    }
    /*
     * admin/user capture associated with
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /*
     * color assiciated with the repository
     */
    public function color()
    {
        return $this->belongsTo(Color::class);
    }
}
