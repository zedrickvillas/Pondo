<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yoeunes\Rateable\Traits\Rateable;
use App;
use App\Models\Favorite;
use Auth;

class Post extends Model
{
	use Rateable;

    protected $table = 'posts';
    public $primaryKey = 'id';
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function comments() {
    	return $this->hasMany('App\Models\Comment');
    }

    public function favorited() {
        return (bool) Favorite::where('user_id', Auth::id())
                                ->where('post_id', $this->id)
                                ->first();
    }
}
