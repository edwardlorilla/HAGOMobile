<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discovery extends Model
{
    protected $fillable = [
        'title', 'description'
    ];
    public function repositories()
    {
        return $this->belongsToMany(Repository::class);
    }
}
