<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    protected $table = 'funds';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['investor','status'];

    public function post(){
        return $this->belongsTo('App\Models\Post');
    }
}
