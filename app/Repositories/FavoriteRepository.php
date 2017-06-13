<?php

namespace App\Repositories;

use App\Models\Favorite;
use InfyOm\Generator\Common\BaseRepository;

class FavoriteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'usersid',
        'file_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Favorite::class;
    }
}
