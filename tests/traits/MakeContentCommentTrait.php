<?php

use Faker\Factory as Faker;
use App\Models\ContentComment;
use App\Repositories\ContentCommentRepository;

trait MakeContentCommentTrait
{
    /**
     * Create fake instance of ContentComment and save it in database
     *
     * @param array $contentCommentFields
     * @return ContentComment
     */
    public function makeContentComment($contentCommentFields = [])
    {
        /** @var ContentCommentRepository $contentCommentRepo */
        $contentCommentRepo = App::make(ContentCommentRepository::class);
        $theme = $this->fakeContentCommentData($contentCommentFields);
        return $contentCommentRepo->create($theme);
    }

    /**
     * Get fake instance of ContentComment
     *
     * @param array $contentCommentFields
     * @return ContentComment
     */
    public function fakeContentComment($contentCommentFields = [])
    {
        return new ContentComment($this->fakeContentCommentData($contentCommentFields));
    }

    /**
     * Get fake data of ContentComment
     *
     * @param array $postFields
     * @return array
     */
    public function fakeContentCommentData($contentCommentFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'comment' => $fake->word,
            'contentsid' => $fake->randomDigitNotNull,
            'usersid' => $fake->randomDigitNotNull
        ], $contentCommentFields);
    }
}
