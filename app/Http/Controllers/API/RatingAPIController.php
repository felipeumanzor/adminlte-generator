<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRatingAPIRequest;
use App\Http\Requests\API\UpdateRatingAPIRequest;
use App\Models\Rating;
use App\Repositories\RatingRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class RatingController
 * @package App\Http\Controllers\API
 */

class RatingAPIController extends AppBaseController
{
    /** @var  RatingRepository */
    private $ratingRepository;

    public function __construct(RatingRepository $ratingRepo)
    {
        $this->ratingRepository = $ratingRepo;
    }

    /**
     * Display a listing of the Rating.
     * GET|HEAD /ratings
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->ratingRepository->pushCriteria(new RequestCriteria($request));
        $this->ratingRepository->pushCriteria(new LimitOffsetCriteria($request));
        $ratings = $this->ratingRepository->all();

        return $this->sendResponse($ratings->toArray(), 'Ratings retrieved successfully');
    }

    /**
     * Store a newly created Rating in storage.
     * POST /ratings
     *
     * @param CreateRatingAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateRatingAPIRequest $request)
    {
        $input = $request->all();

        $ratings = $this->ratingRepository->create($input);

        return $this->sendResponse($ratings->toArray(), 'Rating saved successfully');
    }

    /**
     * Display the specified Rating.
     * GET|HEAD /ratings/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Rating $rating */
        $rating = $this->ratingRepository->findWithoutFail($id);

        if (empty($rating)) {
            return $this->sendError('Rating not found');
        }

        return $this->sendResponse($rating->toArray(), 'Rating retrieved successfully');
    }

    /**
     * Update the specified Rating in storage.
     * PUT/PATCH /ratings/{id}
     *
     * @param  int $id
     * @param UpdateRatingAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRatingAPIRequest $request)
    {
        $input = $request->all();

        /** @var Rating $rating */
        $rating = $this->ratingRepository->findWithoutFail($id);

        if (empty($rating)) {
            return $this->sendError('Rating not found');
        }

        $rating = $this->ratingRepository->update($input, $id);

        return $this->sendResponse($rating->toArray(), 'Rating updated successfully');
    }

    /**
     * Remove the specified Rating from storage.
     * DELETE /ratings/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Rating $rating */
        $rating = $this->ratingRepository->findWithoutFail($id);

        if (empty($rating)) {
            return $this->sendError('Rating not found');
        }

        $rating->delete();

        return $this->sendResponse($id, 'Rating deleted successfully');
    }
}
