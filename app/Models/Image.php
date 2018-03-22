<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['post_id' , 'image'];

    public function post() {
    	return $this->belongsTo('App\Models\Post');
    }
}
