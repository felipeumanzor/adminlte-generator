<?php

namespace App\Repositories;

use App\Models\Files;
use InfyOm\Generator\Common\BaseRepository;

class FilesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'file_url',
        'content_url',
        'usersid',
        'contentsid'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Files::class;
    }
}
