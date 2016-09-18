<?php

namespace Ricoa\Auth\Models;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    public $table = 'roles';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'display_name',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'display_name' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'display_name' => 'required',
        'description' => 'required'
    ];
}
