<?php

use App\Models\Files;
use App\Repositories\FilesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FilesRepositoryTest extends TestCase
{
    use MakeFilesTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var FilesRepository
     */
    protected $filesRepo;

    public function setUp()
    {
        parent::setUp();
        $this->filesRepo = App::make(FilesRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateFiles()
    {
        $files = $this->fakeFilesData();
        $createdFiles = $this->filesRepo->create($files);
        $createdFiles = $createdFiles->toArray();
        $this->assertArrayHasKey('id', $createdFiles);
        $this->assertNotNull($createdFiles['id'], 'Created Files must have id specified');
        $this->assertNotNull(Files::find($createdFiles['id']), 'Files with given id must be in DB');
        $this->assertModelData($files, $createdFiles);
    }

    /**
     * @test read
     */
    public function testReadFiles()
    {
        $files = $this->makeFiles();
        $dbFiles = $this->filesRepo->find($files->id);
        $dbFiles = $dbFiles->toArray();
        $this->assertModelData($files->toArray(), $dbFiles);
    }

    /**
     * @test update
     */
    public function testUpdateFiles()
    {
        $files = $this->makeFiles();
        $fakeFiles = $this->fakeFilesData();
        $updatedFiles = $this->filesRepo->update($fakeFiles, $files->id);
        $this->assertModelData($fakeFiles, $updatedFiles->toArray());
        $dbFiles = $this->filesRepo->find($files->id);
        $this->assertModelData($fakeFiles, $dbFiles->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteFiles()
    {
        $files = $this->makeFiles();
        $resp = $this->filesRepo->delete($files->id);
        $this->assertTrue($resp);
        $this->assertNull(Files::find($files->id), 'Files should not exist in DB');
    }
}
