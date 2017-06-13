<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateContentCommentAPIRequest;
use App\Http\Requests\API\UpdateContentCommentAPIRequest;
use App\Models\ContentComment;
use App\Repositories\ContentCommentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ContentCommentController
 * @package App\Http\Controllers\API
 */

class ContentCommentAPIController extends AppBaseController
{
    /** @var  ContentCommentRepository */
    private $contentCommentRepository;

    public function __construct(ContentCommentRepository $contentCommentRepo)
    {
        $this->contentCommentRepository = $contentCommentRepo;
    }

    /**
     * Display a listing of the ContentComment.
     * GET|HEAD /contentComments
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->contentCommentRepository->pushCriteria(new RequestCriteria($request));
        $this->contentCommentRepository->pushCriteria(new LimitOffsetCriteria($request));
        $contentComments = $this->contentCommentRepository->all();

        return $this->sendResponse($contentComments->toArray(), 'Content Comments retrieved successfully');
    }

    /**
     * Store a newly created ContentComment in storage.
     * POST /contentComments
     *
     * @param CreateContentCommentAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateContentCommentAPIRequest $request)
    {
        $input = $request->all();

        $contentComments = $this->contentCommentRepository->create($input);

        return $this->sendResponse($contentComments->toArray(), 'Content Comment saved successfully');
    }

    /**
     * Display the specified ContentComment.
     * GET|HEAD /contentComments/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ContentComment $contentComment */
        $contentComment = $this->contentCommentRepository->findWithoutFail($id);

        if (empty($contentComment)) {
            return $this->sendError('Content Comment not found');
        }

        return $this->sendResponse($contentComment->toArray(), 'Content Comment retrieved successfully');
    }

    /**
     * Update the specified ContentComment in storage.
     * PUT/PATCH /contentComments/{id}
     *
     * @param  int $id
     * @param UpdateContentCommentAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateContentCommentAPIRequest $request)
    {
        $input = $request->all();

        /** @var ContentComment $contentComment */
        $contentComment = $this->contentCommentRepository->findWithoutFail($id);

        if (empty($contentComment)) {
            return $this->sendError('Content Comment not found');
        }

        $contentComment = $this->contentCommentRepository->update($input, $id);

        return $this->sendResponse($contentComment->toArray(), 'ContentComment updated successfully');
    }

    /**
     * Remove the specified ContentComment from storage.
     * DELETE /contentComments/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ContentComment $contentComment */
        $contentComment = $this->contentCommentRepository->findWithoutFail($id);

        if (empty($contentComment)) {
            return $this->sendError('Content Comment not found');
        }

        $contentComment->delete();

        return $this->sendResponse($id, 'Content Comment deleted successfully');
    }
}
