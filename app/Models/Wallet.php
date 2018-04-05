<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yoeunes\Rateable\Traits\Rateable;
use Auth;

class Wallet extends Model
{

    use Rateable;

    protected $table = 'wallet';
    public $primaryKey = 'id';

    protected $fillable = [
        'balance',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
