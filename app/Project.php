<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public $timestamps = false;

    public function endpoints()
    {
        return $this->hasMany('App\Endpoint', 'projectId');
    }
}
