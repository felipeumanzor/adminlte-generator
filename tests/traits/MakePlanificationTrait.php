<?php

use Faker\Factory as Faker;
use App\Models\Planification;
use App\Repositories\PlanificationRepository;

trait MakePlanificationTrait
{
    /**
     * Create fake instance of Planification and save it in database
     *
     * @param array $planificationFields
     * @return Planification
     */
    public function makePlanification($planificationFields = [])
    {
        /** @var PlanificationRepository $planificationRepo */
        $planificationRepo = App::make(PlanificationRepository::class);
        $theme = $this->fakePlanificationData($planificationFields);
        return $planificationRepo->create($theme);
    }

    /**
     * Get fake instance of Planification
     *
     * @param array $planificationFields
     * @return Planification
     */
    public function fakePlanification($planificationFields = [])
    {
        return new Planification($this->fakePlanificationData($planificationFields));
    }

    /**
     * Get fake data of Planification
     *
     * @param array $postFields
     * @return array
     */
    public function fakePlanificationData($planificationFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'usersid' => $fake->randomDigitNotNull
        ], $planificationFields);
    }
}
