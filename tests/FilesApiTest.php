<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FilesApiTest extends TestCase
{
    use MakeFilesTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateFiles()
    {
        $files = $this->fakeFilesData();
        $this->json('POST', '/api/v1/files', $files);

        $this->assertApiResponse($files);
    }

    /**
     * @test
     */
    public function testReadFiles()
    {
        $files = $this->makeFiles();
        $this->json('GET', '/api/v1/files/'.$files->id);

        $this->assertApiResponse($files->toArray());
    }

    /**
     * @test
     */
    public function testUpdateFiles()
    {
        $files = $this->makeFiles();
        $editedFiles = $this->fakeFilesData();

        $this->json('PUT', '/api/v1/files/'.$files->id, $editedFiles);

        $this->assertApiResponse($editedFiles);
    }

    /**
     * @test
     */
    public function testDeleteFiles()
    {
        $files = $this->makeFiles();
        $this->json('DELETE', '/api/v1/files/'.$files->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/files/'.$files->id);

        $this->assertResponseStatus(404);
    }
}
