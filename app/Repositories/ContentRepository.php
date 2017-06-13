<?php

namespace App\Repositories;

use App\Models\Content;
use InfyOm\Generator\Common\BaseRepository;

class ContentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id_mineduc',
        'name',
        'subjectsid'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Content::class;
    }
}
