<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    public function repositories()
    {
        return $this->belongsToMany(Repository::class);
    }
}
