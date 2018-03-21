<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $fillable = [
    	'project_name',
    	'project_desc',
    	'company_id',
    	'user_id',
    	'project_deadline',
    ];

    public function users(){
        return $this->belongsToMany('App\User');
    }
    public function company(){
        return $this->belongsTo('App\Company');
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
}
