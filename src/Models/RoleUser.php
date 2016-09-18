<?php

namespace Ricoa\Auth\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    public $table = 'role_user';


    protected $fillable=[
        'user_id',
        'role_id'
    ];

    public $timestamps=false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
