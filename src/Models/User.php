<?php

namespace Ricoa\Auth\Models;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model
{
    use EntrustUserTrait;

    public $table = 'users';


    public function setPasswordAttribute($password){
        $this->attributes['password'] = bcrypt($password);
    }

    public function beRole($name)
    {
        $admin=Role::where("name",$name)->first();
        $this->attachRole($admin);
    }
}
