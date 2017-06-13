<?php

use App\Models\ContentComment;
use App\Repositories\ContentCommentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ContentCommentRepositoryTest extends TestCase
{
    use MakeContentCommentTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ContentCommentRepository
     */
    protected $contentCommentRepo;

    public function setUp()
    {
        parent::setUp();
        $this->contentCommentRepo = App::make(ContentCommentRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateContentComment()
    {
        $contentComment = $this->fakeContentCommentData();
        $createdContentComment = $this->contentCommentRepo->create($contentComment);
        $createdContentComment = $createdContentComment->toArray();
        $this->assertArrayHasKey('id', $createdContentComment);
        $this->assertNotNull($createdContentComment['id'], 'Created ContentComment must have id specified');
        $this->assertNotNull(ContentComment::find($createdContentComment['id']), 'ContentComment with given id must be in DB');
        $this->assertModelData($contentComment, $createdContentComment);
    }

    /**
     * @test read
     */
    public function testReadContentComment()
    {
        $contentComment = $this->makeContentComment();
        $dbContentComment = $this->contentCommentRepo->find($contentComment->id);
        $dbContentComment = $dbContentComment->toArray();
        $this->assertModelData($contentComment->toArray(), $dbContentComment);
    }

    /**
     * @test update
     */
    public function testUpdateContentComment()
    {
        $contentComment = $this->makeContentComment();
        $fakeContentComment = $this->fakeContentCommentData();
        $updatedContentComment = $this->contentCommentRepo->update($fakeContentComment, $contentComment->id);
        $this->assertModelData($fakeContentComment, $updatedContentComment->toArray());
        $dbContentComment = $this->contentCommentRepo->find($contentComment->id);
        $this->assertModelData($fakeContentComment, $dbContentComment->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteContentComment()
    {
        $contentComment = $this->makeContentComment();
        $resp = $this->contentCommentRepo->delete($contentComment->id);
        $this->assertTrue($resp);
        $this->assertNull(ContentComment::find($contentComment->id), 'ContentComment should not exist in DB');
    }
}
