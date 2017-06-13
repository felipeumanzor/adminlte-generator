<?php

use Faker\Factory as Faker;
use App\Models\Rating;
use App\Repositories\RatingRepository;

trait MakeRatingTrait
{
    /**
     * Create fake instance of Rating and save it in database
     *
     * @param array $ratingFields
     * @return Rating
     */
    public function makeRating($ratingFields = [])
    {
        /** @var RatingRepository $ratingRepo */
        $ratingRepo = App::make(RatingRepository::class);
        $theme = $this->fakeRatingData($ratingFields);
        return $ratingRepo->create($theme);
    }

    /**
     * Get fake instance of Rating
     *
     * @param array $ratingFields
     * @return Rating
     */
    public function fakeRating($ratingFields = [])
    {
        return new Rating($this->fakeRatingData($ratingFields));
    }

    /**
     * Get fake data of Rating
     *
     * @param array $postFields
     * @return array
     */
    public function fakeRatingData($ratingFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'rate' => $fake->word,
            'contentsid' => $fake->randomDigitNotNull,
            'usersid' => $fake->randomDigitNotNull
        ], $ratingFields);
    }
}
