<?php

use App\Models\Planification;
use App\Repositories\PlanificationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PlanificationRepositoryTest extends TestCase
{
    use MakePlanificationTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PlanificationRepository
     */
    protected $planificationRepo;

    public function setUp()
    {
        parent::setUp();
        $this->planificationRepo = App::make(PlanificationRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePlanification()
    {
        $planification = $this->fakePlanificationData();
        $createdPlanification = $this->planificationRepo->create($planification);
        $createdPlanification = $createdPlanification->toArray();
        $this->assertArrayHasKey('id', $createdPlanification);
        $this->assertNotNull($createdPlanification['id'], 'Created Planification must have id specified');
        $this->assertNotNull(Planification::find($createdPlanification['id']), 'Planification with given id must be in DB');
        $this->assertModelData($planification, $createdPlanification);
    }

    /**
     * @test read
     */
    public function testReadPlanification()
    {
        $planification = $this->makePlanification();
        $dbPlanification = $this->planificationRepo->find($planification->id);
        $dbPlanification = $dbPlanification->toArray();
        $this->assertModelData($planification->toArray(), $dbPlanification);
    }

    /**
     * @test update
     */
    public function testUpdatePlanification()
    {
        $planification = $this->makePlanification();
        $fakePlanification = $this->fakePlanificationData();
        $updatedPlanification = $this->planificationRepo->update($fakePlanification, $planification->id);
        $this->assertModelData($fakePlanification, $updatedPlanification->toArray());
        $dbPlanification = $this->planificationRepo->find($planification->id);
        $this->assertModelData($fakePlanification, $dbPlanification->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePlanification()
    {
        $planification = $this->makePlanification();
        $resp = $this->planificationRepo->delete($planification->id);
        $this->assertTrue($resp);
        $this->assertNull(Planification::find($planification->id), 'Planification should not exist in DB');
    }
}
