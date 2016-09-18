<?php

namespace Ricoa\Auth\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Ricoa\Auth\Models\RoleUser;

class RoleUserRepository extends BaseRepository
{


    /**
     * Configure the Model
     **/
    public function model()
    {
        return RoleUser::class;
    }
}
