<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PlanificationApiTest extends TestCase
{
    use MakePlanificationTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePlanification()
    {
        $planification = $this->fakePlanificationData();
        $this->json('POST', '/api/v1/planifications', $planification);

        $this->assertApiResponse($planification);
    }

    /**
     * @test
     */
    public function testReadPlanification()
    {
        $planification = $this->makePlanification();
        $this->json('GET', '/api/v1/planifications/'.$planification->id);

        $this->assertApiResponse($planification->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePlanification()
    {
        $planification = $this->makePlanification();
        $editedPlanification = $this->fakePlanificationData();

        $this->json('PUT', '/api/v1/planifications/'.$planification->id, $editedPlanification);

        $this->assertApiResponse($editedPlanification);
    }

    /**
     * @test
     */
    public function testDeletePlanification()
    {
        $planification = $this->makePlanification();
        $this->json('DELETE', '/api/v1/planifications/'.$planification->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/planifications/'.$planification->id);

        $this->assertResponseStatus(404);
    }
}
