<?php

namespace App\Repositories;

use App\Models\ContentComment;
use InfyOm\Generator\Common\BaseRepository;

class ContentCommentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'comment',
        'contentsid',
        'usersid'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ContentComment::class;
    }
}
