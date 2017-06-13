<?php

use Faker\Factory as Faker;
use App\Models\Users;
use App\Repositories\UsersRepository;

trait MakeUsersTrait
{
    /**
     * Create fake instance of Users and save it in database
     *
     * @param array $usersFields
     * @return Users
     */
    public function makeUsers($usersFields = [])
    {
        /** @var UsersRepository $usersRepo */
        $usersRepo = App::make(UsersRepository::class);
        $theme = $this->fakeUsersData($usersFields);
        return $usersRepo->create($theme);
    }

    /**
     * Get fake instance of Users
     *
     * @param array $usersFields
     * @return Users
     */
    public function fakeUsers($usersFields = [])
    {
        return new Users($this->fakeUsersData($usersFields));
    }

    /**
     * Get fake data of Users
     *
     * @param array $postFields
     * @return array
     */
    public function fakeUsersData($usersFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'email' => $fake->word,
            'password' => $fake->word,
            'profile_pic' => $fake->word,
            'remember_token' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $usersFields);
    }
}
