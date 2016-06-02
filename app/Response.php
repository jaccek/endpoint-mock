<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    public function modifications()
    {
        return $this->hasMany('App\Modification', 'responseId');
    }

    public function endpoints()
    {
        return $this->belongsToMany('App\Endpoint', 'responseId');
    }
}
