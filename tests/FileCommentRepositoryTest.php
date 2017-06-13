<?php

use App\Models\FileComment;
use App\Repositories\FileCommentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FileCommentRepositoryTest extends TestCase
{
    use MakeFileCommentTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var FileCommentRepository
     */
    protected $fileCommentRepo;

    public function setUp()
    {
        parent::setUp();
        $this->fileCommentRepo = App::make(FileCommentRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateFileComment()
    {
        $fileComment = $this->fakeFileCommentData();
        $createdFileComment = $this->fileCommentRepo->create($fileComment);
        $createdFileComment = $createdFileComment->toArray();
        $this->assertArrayHasKey('id', $createdFileComment);
        $this->assertNotNull($createdFileComment['id'], 'Created FileComment must have id specified');
        $this->assertNotNull(FileComment::find($createdFileComment['id']), 'FileComment with given id must be in DB');
        $this->assertModelData($fileComment, $createdFileComment);
    }

    /**
     * @test read
     */
    public function testReadFileComment()
    {
        $fileComment = $this->makeFileComment();
        $dbFileComment = $this->fileCommentRepo->find($fileComment->id);
        $dbFileComment = $dbFileComment->toArray();
        $this->assertModelData($fileComment->toArray(), $dbFileComment);
    }

    /**
     * @test update
     */
    public function testUpdateFileComment()
    {
        $fileComment = $this->makeFileComment();
        $fakeFileComment = $this->fakeFileCommentData();
        $updatedFileComment = $this->fileCommentRepo->update($fakeFileComment, $fileComment->id);
        $this->assertModelData($fakeFileComment, $updatedFileComment->toArray());
        $dbFileComment = $this->fileCommentRepo->find($fileComment->id);
        $this->assertModelData($fakeFileComment, $dbFileComment->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteFileComment()
    {
        $fileComment = $this->makeFileComment();
        $resp = $this->fileCommentRepo->delete($fileComment->id);
        $this->assertTrue($resp);
        $this->assertNull(FileComment::find($fileComment->id), 'FileComment should not exist in DB');
    }
}
