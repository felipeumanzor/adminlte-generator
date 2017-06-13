<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ContentCommentApiTest extends TestCase
{
    use MakeContentCommentTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateContentComment()
    {
        $contentComment = $this->fakeContentCommentData();
        $this->json('POST', '/api/v1/contentComments', $contentComment);

        $this->assertApiResponse($contentComment);
    }

    /**
     * @test
     */
    public function testReadContentComment()
    {
        $contentComment = $this->makeContentComment();
        $this->json('GET', '/api/v1/contentComments/'.$contentComment->id);

        $this->assertApiResponse($contentComment->toArray());
    }

    /**
     * @test
     */
    public function testUpdateContentComment()
    {
        $contentComment = $this->makeContentComment();
        $editedContentComment = $this->fakeContentCommentData();

        $this->json('PUT', '/api/v1/contentComments/'.$contentComment->id, $editedContentComment);

        $this->assertApiResponse($editedContentComment);
    }

    /**
     * @test
     */
    public function testDeleteContentComment()
    {
        $contentComment = $this->makeContentComment();
        $this->json('DELETE', '/api/v1/contentComments/'.$contentComment->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/contentComments/'.$contentComment->id);

        $this->assertResponseStatus(404);
    }
}
