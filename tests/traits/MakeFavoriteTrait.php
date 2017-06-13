<?php

use Faker\Factory as Faker;
use App\Models\Favorite;
use App\Repositories\FavoriteRepository;

trait MakeFavoriteTrait
{
    /**
     * Create fake instance of Favorite and save it in database
     *
     * @param array $favoriteFields
     * @return Favorite
     */
    public function makeFavorite($favoriteFields = [])
    {
        /** @var FavoriteRepository $favoriteRepo */
        $favoriteRepo = App::make(FavoriteRepository::class);
        $theme = $this->fakeFavoriteData($favoriteFields);
        return $favoriteRepo->create($theme);
    }

    /**
     * Get fake instance of Favorite
     *
     * @param array $favoriteFields
     * @return Favorite
     */
    public function fakeFavorite($favoriteFields = [])
    {
        return new Favorite($this->fakeFavoriteData($favoriteFields));
    }

    /**
     * Get fake data of Favorite
     *
     * @param array $postFields
     * @return array
     */
    public function fakeFavoriteData($favoriteFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'usersid' => $fake->randomDigitNotNull,
            'file_id' => $fake->randomDigitNotNull
        ], $favoriteFields);
    }
}
