<?php

use Faker\Factory as Faker;
use App\Models\Files;
use App\Repositories\FilesRepository;

trait MakeFilesTrait
{
    /**
     * Create fake instance of Files and save it in database
     *
     * @param array $filesFields
     * @return Files
     */
    public function makeFiles($filesFields = [])
    {
        /** @var FilesRepository $filesRepo */
        $filesRepo = App::make(FilesRepository::class);
        $theme = $this->fakeFilesData($filesFields);
        return $filesRepo->create($theme);
    }

    /**
     * Get fake instance of Files
     *
     * @param array $filesFields
     * @return Files
     */
    public function fakeFiles($filesFields = [])
    {
        return new Files($this->fakeFilesData($filesFields));
    }

    /**
     * Get fake data of Files
     *
     * @param array $postFields
     * @return array
     */
    public function fakeFilesData($filesFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'description' => $fake->word,
            'file_url' => $fake->word,
            'content_url' => $fake->word,
            'usersid' => $fake->randomDigitNotNull,
            'contentsid' => $fake->randomDigitNotNull
        ], $filesFields);
    }
}
