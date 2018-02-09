<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repository extends Model
{
    protected $fillable = [
        'title', 'specie', 'commonName', 'localName', 'location', 'economicImportance', 'estimatedDensity', 'threats',
        'pathwaySpread', 'remarks', 'description', 'scientificName', 'latitude', 'longitude', 'altitude', 'color_id',
        'repository_id', 'category_id', 'distribution_id', 'family_id', 'published'
    ];

    /**
     * Get the photos associated with the given Repository
     */
    public function photos()
    {
        return $this->belongsToMany(Photo::class);
    }

    public function vegetations()
    {
        return $this->belongsToMany(Vegetation::class);
    }


    /*
     * admin/user capture associated with
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function distribution()
    {
        return $this->belongsTo(Distribution::class);
    }

    public function family()
    {
        return $this->belongsTo(Family::class);
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
