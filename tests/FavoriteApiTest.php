<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FavoriteApiTest extends TestCase
{
    use MakeFavoriteTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateFavorite()
    {
        $favorite = $this->fakeFavoriteData();
        $this->json('POST', '/api/v1/favorites', $favorite);

        $this->assertApiResponse($favorite);
    }

    /**
     * @test
     */
    public function testReadFavorite()
    {
        $favorite = $this->makeFavorite();
        $this->json('GET', '/api/v1/favorites/'.$favorite->id);

        $this->assertApiResponse($favorite->toArray());
    }

    /**
     * @test
     */
    public function testUpdateFavorite()
    {
        $favorite = $this->makeFavorite();
        $editedFavorite = $this->fakeFavoriteData();

        $this->json('PUT', '/api/v1/favorites/'.$favorite->id, $editedFavorite);

        $this->assertApiResponse($editedFavorite);
    }

    /**
     * @test
     */
    public function testDeleteFavorite()
    {
        $favorite = $this->makeFavorite();
        $this->json('DELETE', '/api/v1/favorites/'.$favorite->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/favorites/'.$favorite->id);

        $this->assertResponseStatus(404);
    }
}
