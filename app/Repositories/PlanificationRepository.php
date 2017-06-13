<?php

namespace App\Repositories;

use App\Models\Planification;
use InfyOm\Generator\Common\BaseRepository;

class PlanificationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'usersid'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Planification::class;
    }
}
