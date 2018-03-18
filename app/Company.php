<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $fillable = [
    	'company_name',
    	'company_desc',
    	'user_id',
    ];

     public function user(){
        return $this->belongsTo('App\User');
    }

     public function projects(){
        return $this->hasMany('App\Project');
    }

     public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

}
