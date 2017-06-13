<?php

use Faker\Factory as Faker;
use App\Models\FileComment;
use App\Repositories\FileCommentRepository;

trait MakeFileCommentTrait
{
    /**
     * Create fake instance of FileComment and save it in database
     *
     * @param array $fileCommentFields
     * @return FileComment
     */
    public function makeFileComment($fileCommentFields = [])
    {
        /** @var FileCommentRepository $fileCommentRepo */
        $fileCommentRepo = App::make(FileCommentRepository::class);
        $theme = $this->fakeFileCommentData($fileCommentFields);
        return $fileCommentRepo->create($theme);
    }

    /**
     * Get fake instance of FileComment
     *
     * @param array $fileCommentFields
     * @return FileComment
     */
    public function fakeFileComment($fileCommentFields = [])
    {
        return new FileComment($this->fakeFileCommentData($fileCommentFields));
    }

    /**
     * Get fake data of FileComment
     *
     * @param array $postFields
     * @return array
     */
    public function fakeFileCommentData($fileCommentFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'comment' => $fake->word,
            'usersid' => $fake->randomDigitNotNull,
            'filesid' => $fake->randomDigitNotNull
        ], $fileCommentFields);
    }
}
