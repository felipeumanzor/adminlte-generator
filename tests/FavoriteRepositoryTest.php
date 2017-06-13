<?php

use App\Models\Favorite;
use App\Repositories\FavoriteRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FavoriteRepositoryTest extends TestCase
{
    use MakeFavoriteTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var FavoriteRepository
     */
    protected $favoriteRepo;

    public function setUp()
    {
        parent::setUp();
        $this->favoriteRepo = App::make(FavoriteRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateFavorite()
    {
        $favorite = $this->fakeFavoriteData();
        $createdFavorite = $this->favoriteRepo->create($favorite);
        $createdFavorite = $createdFavorite->toArray();
        $this->assertArrayHasKey('id', $createdFavorite);
        $this->assertNotNull($createdFavorite['id'], 'Created Favorite must have id specified');
        $this->assertNotNull(Favorite::find($createdFavorite['id']), 'Favorite with given id must be in DB');
        $this->assertModelData($favorite, $createdFavorite);
    }

    /**
     * @test read
     */
    public function testReadFavorite()
    {
        $favorite = $this->makeFavorite();
        $dbFavorite = $this->favoriteRepo->find($favorite->id);
        $dbFavorite = $dbFavorite->toArray();
        $this->assertModelData($favorite->toArray(), $dbFavorite);
    }

    /**
     * @test update
     */
    public function testUpdateFavorite()
    {
        $favorite = $this->makeFavorite();
        $fakeFavorite = $this->fakeFavoriteData();
        $updatedFavorite = $this->favoriteRepo->update($fakeFavorite, $favorite->id);
        $this->assertModelData($fakeFavorite, $updatedFavorite->toArray());
        $dbFavorite = $this->favoriteRepo->find($favorite->id);
        $this->assertModelData($fakeFavorite, $dbFavorite->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteFavorite()
    {
        $favorite = $this->makeFavorite();
        $resp = $this->favoriteRepo->delete($favorite->id);
        $this->assertTrue($resp);
        $this->assertNull(Favorite::find($favorite->id), 'Favorite should not exist in DB');
    }
}
