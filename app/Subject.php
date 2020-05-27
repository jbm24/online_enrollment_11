<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    /**
     * Get the enrolled students for the subject
     */
    public function enrollee()
    {
        return $this->hasMany('App\Enrollee');
    }
}
