<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFileCommentAPIRequest;
use App\Http\Requests\API\UpdateFileCommentAPIRequest;
use App\Models\FileComment;
use App\Repositories\FileCommentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class FileCommentController
 * @package App\Http\Controllers\API
 */

class FileCommentAPIController extends AppBaseController
{
    /** @var  FileCommentRepository */
    private $fileCommentRepository;

    public function __construct(FileCommentRepository $fileCommentRepo)
    {
        $this->fileCommentRepository = $fileCommentRepo;
    }

    /**
     * Display a listing of the FileComment.
     * GET|HEAD /fileComments
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->fileCommentRepository->pushCriteria(new RequestCriteria($request));
        $this->fileCommentRepository->pushCriteria(new LimitOffsetCriteria($request));
        $fileComments = $this->fileCommentRepository->all();

        return $this->sendResponse($fileComments->toArray(), 'File Comments retrieved successfully');
    }

    /**
     * Store a newly created FileComment in storage.
     * POST /fileComments
     *
     * @param CreateFileCommentAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateFileCommentAPIRequest $request)
    {
        $input = $request->all();

        $fileComments = $this->fileCommentRepository->create($input);

        return $this->sendResponse($fileComments->toArray(), 'File Comment saved successfully');
    }

    /**
     * Display the specified FileComment.
     * GET|HEAD /fileComments/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var FileComment $fileComment */
        $fileComment = $this->fileCommentRepository->findWithoutFail($id);

        if (empty($fileComment)) {
            return $this->sendError('File Comment not found');
        }

        return $this->sendResponse($fileComment->toArray(), 'File Comment retrieved successfully');
    }

    /**
     * Update the specified FileComment in storage.
     * PUT/PATCH /fileComments/{id}
     *
     * @param  int $id
     * @param UpdateFileCommentAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFileCommentAPIRequest $request)
    {
        $input = $request->all();

        /** @var FileComment $fileComment */
        $fileComment = $this->fileCommentRepository->findWithoutFail($id);

        if (empty($fileComment)) {
            return $this->sendError('File Comment not found');
        }

        $fileComment = $this->fileCommentRepository->update($input, $id);

        return $this->sendResponse($fileComment->toArray(), 'FileComment updated successfully');
    }

    /**
     * Remove the specified FileComment from storage.
     * DELETE /fileComments/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var FileComment $fileComment */
        $fileComment = $this->fileCommentRepository->findWithoutFail($id);

        if (empty($fileComment)) {
            return $this->sendError('File Comment not found');
        }

        $fileComment->delete();

        return $this->sendResponse($id, 'File Comment deleted successfully');
    }
}
