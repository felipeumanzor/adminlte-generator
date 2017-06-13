<?php

namespace App\Repositories;

use App\Models\FileComment;
use InfyOm\Generator\Common\BaseRepository;

class FileCommentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'comment',
        'usersid',
        'filesid'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return FileComment::class;
    }
}
