<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFavoriteAPIRequest;
use App\Http\Requests\API\UpdateFavoriteAPIRequest;
use App\Models\Favorite;
use App\Repositories\FavoriteRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class FavoriteController
 * @package App\Http\Controllers\API
 */

class FavoriteAPIController extends AppBaseController
{
    /** @var  FavoriteRepository */
    private $favoriteRepository;

    public function __construct(FavoriteRepository $favoriteRepo)
    {
        $this->favoriteRepository = $favoriteRepo;
    }

    /**
     * Display a listing of the Favorite.
     * GET|HEAD /favorites
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->favoriteRepository->pushCriteria(new RequestCriteria($request));
        $this->favoriteRepository->pushCriteria(new LimitOffsetCriteria($request));
        $favorites = $this->favoriteRepository->all();

        return $this->sendResponse($favorites->toArray(), 'Favorites retrieved successfully');
    }

    /**
     * Store a newly created Favorite in storage.
     * POST /favorites
     *
     * @param CreateFavoriteAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateFavoriteAPIRequest $request)
    {
        $input = $request->all();

        $favorites = $this->favoriteRepository->create($input);

        return $this->sendResponse($favorites->toArray(), 'Favorite saved successfully');
    }

    /**
     * Display the specified Favorite.
     * GET|HEAD /favorites/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Favorite $favorite */
        $favorite = $this->favoriteRepository->findWithoutFail($id);

        if (empty($favorite)) {
            return $this->sendError('Favorite not found');
        }

        return $this->sendResponse($favorite->toArray(), 'Favorite retrieved successfully');
    }

    /**
     * Update the specified Favorite in storage.
     * PUT/PATCH /favorites/{id}
     *
     * @param  int $id
     * @param UpdateFavoriteAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFavoriteAPIRequest $request)
    {
        $input = $request->all();

        /** @var Favorite $favorite */
        $favorite = $this->favoriteRepository->findWithoutFail($id);

        if (empty($favorite)) {
            return $this->sendError('Favorite not found');
        }

        $favorite = $this->favoriteRepository->update($input, $id);

        return $this->sendResponse($favorite->toArray(), 'Favorite updated successfully');
    }

    /**
     * Remove the specified Favorite from storage.
     * DELETE /favorites/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Favorite $favorite */
        $favorite = $this->favoriteRepository->findWithoutFail($id);

        if (empty($favorite)) {
            return $this->sendError('Favorite not found');
        }

        $favorite->delete();

        return $this->sendResponse($id, 'Favorite deleted successfully');
    }
}
