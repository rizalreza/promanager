<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    //
     protected $fillable = [
    	'project_id',
    	'user_id',
    	
    ];

    public function project(){
        return $this->belongsTo('App\Project');
    }
}
