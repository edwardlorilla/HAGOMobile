<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public function repositories()
    {
        return $this->belongsToMany(Repository::class);
    }
}
