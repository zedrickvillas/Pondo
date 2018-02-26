<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{

    use HasRoleAndPermission;
    use Notifiable;
    use SoftDeletes;

    protected $table = 'businesses';
    protected $guarded = 'id';

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
