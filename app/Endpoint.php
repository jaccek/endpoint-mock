<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endpoint extends Model
{
    public $timestamps = false;
    
    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function parameters()
    {
        return $this->hasMany('App\Parameter', 'endpointId');
    }

    public function modifications()
    {
        return $this->belongsToMany('App\Modification', 'responses', 'endpointId', 'modificationId');
    }
}
