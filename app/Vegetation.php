<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vegetation extends Model
{
    protected $fillable =['name'];
    public function repositories()
    {
        return $this->belongsToMany(Repository::class);
    }
}
