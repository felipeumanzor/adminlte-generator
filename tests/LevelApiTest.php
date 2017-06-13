<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LevelApiTest extends TestCase
{
    use MakeLevelTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateLevel()
    {
        $level = $this->fakeLevelData();
        $this->json('POST', '/api/v1/levels', $level);

        $this->assertApiResponse($level);
    }

    /**
     * @test
     */
    public function testReadLevel()
    {
        $level = $this->makeLevel();
        $this->json('GET', '/api/v1/levels/'.$level->id);

        $this->assertApiResponse($level->toArray());
    }

    /**
     * @test
     */
    public function testUpdateLevel()
    {
        $level = $this->makeLevel();
        $editedLevel = $this->fakeLevelData();

        $this->json('PUT', '/api/v1/levels/'.$level->id, $editedLevel);

        $this->assertApiResponse($editedLevel);
    }

    /**
     * @test
     */
    public function testDeleteLevel()
    {
        $level = $this->makeLevel();
        $this->json('DELETE', '/api/v1/levels/'.$level->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/levels/'.$level->id);

        $this->assertResponseStatus(404);
    }
}
