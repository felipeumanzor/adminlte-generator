<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FileCommentApiTest extends TestCase
{
    use MakeFileCommentTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateFileComment()
    {
        $fileComment = $this->fakeFileCommentData();
        $this->json('POST', '/api/v1/fileComments', $fileComment);

        $this->assertApiResponse($fileComment);
    }

    /**
     * @test
     */
    public function testReadFileComment()
    {
        $fileComment = $this->makeFileComment();
        $this->json('GET', '/api/v1/fileComments/'.$fileComment->id);

        $this->assertApiResponse($fileComment->toArray());
    }

    /**
     * @test
     */
    public function testUpdateFileComment()
    {
        $fileComment = $this->makeFileComment();
        $editedFileComment = $this->fakeFileCommentData();

        $this->json('PUT', '/api/v1/fileComments/'.$fileComment->id, $editedFileComment);

        $this->assertApiResponse($editedFileComment);
    }

    /**
     * @test
     */
    public function testDeleteFileComment()
    {
        $fileComment = $this->makeFileComment();
        $this->json('DELETE', '/api/v1/fileComments/'.$fileComment->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/fileComments/'.$fileComment->id);

        $this->assertResponseStatus(404);
    }
}
