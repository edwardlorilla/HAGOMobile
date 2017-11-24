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
    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }
}
