<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /**
     * Get the enrolled subjects for each student
     */
    public function enrolled()
    {
        return $this->hasMany('App\Enrollee');
    }
}
