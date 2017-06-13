<?php

namespace App\Repositories;

use App\Models\Level;
use InfyOm\Generator\Common\BaseRepository;

class LevelRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'cycle'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Level::class;
    }
}
