<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yoeunes\Rateable\Traits\Rateable;

class Business extends Model
{
    use Rateable;

    protected $fillable = [
        'name',
        'user_id',
        'nature',
        'address',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
