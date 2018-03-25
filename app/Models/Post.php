<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yoeunes\Rateable\Traits\Rateable;
use App;
use App\Models\Favorite;
use Auth;
use App\Models\User;

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

    public function images() {
        return $this->hasMany('App\Models\Image');
    }

    public function favorited() {
        return (bool) Favorite::where('user_id', Auth::id())
                                ->where('post_id', $this->id)
                                ->first();
    }

    public function getAll($limit) {
        return $limit;
    }

    public function followersCount() {
        $followers_count =  Favorite::where('post_id', $this->id)->count();
        return $followers_count;
    }

    public function followersEmails() {

        $favorited_post =  Favorite::where('post_id', $this->id)->get();

        $investors = User::whereHas('roles', function($q) {
                            $q->where('slug', 'investor');
                        }
                    )->get();


        $followers_emails = [];

        foreach ($favorited_post as $favpost) {
            foreach ($investors as $investor) {
                if ($favpost->user_id == $investor->id) {
                    array_push($followers_emails, $investor->email);
                }
            }
        }
     

        return $followers_emails;
    }

}
