<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'file'
    ];
    public function repositories()
    {
        return $this->belongsToMany(Repository::class);
    }
    public function discoveries()
    {
        return $this->belongsToMany(Discovery::class);
    }
}
