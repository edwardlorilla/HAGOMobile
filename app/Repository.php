<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repository extends Model
{
    protected $fillable =[
      'title', 'description', 'scientificName', 'latitude', 'longitude', 'altitude', 'color_id', 'repository_id'
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

    public function repository()
    {
        return $this->belongsTo(Repository::class);
    }
    /*
     * color assiciated with the repository
     */
    public function color()
    {
        return $this->belongsTo(Color::class);
    }
}
