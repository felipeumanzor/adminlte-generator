<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFilesAPIRequest;
use App\Http\Requests\API\UpdateFilesAPIRequest;
use App\Models\Files;
use App\Repositories\FilesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class FilesController
 * @package App\Http\Controllers\API
 */

class FilesAPIController extends AppBaseController
{
    /** @var  FilesRepository */
    private $filesRepository;

    public function __construct(FilesRepository $filesRepo)
    {
        $this->filesRepository = $filesRepo;
    }

    /**
     * Display a listing of the Files.
     * GET|HEAD /files
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->filesRepository->pushCriteria(new RequestCriteria($request));
        $this->filesRepository->pushCriteria(new LimitOffsetCriteria($request));
        $files = $this->filesRepository->all();

        return $this->sendResponse($files->toArray(), 'Files retrieved successfully');
    }

    /**
     * Store a newly created Files in storage.
     * POST /files
     *
     * @param CreateFilesAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateFilesAPIRequest $request)
    {
        $input = $request->all();

        $files = $this->filesRepository->create($input);

        return $this->sendResponse($files->toArray(), 'Files saved successfully');
    }

    /**
     * Display the specified Files.
     * GET|HEAD /files/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Files $files */
        $files = $this->filesRepository->findWithoutFail($id);

        if (empty($files)) {
            return $this->sendError('Files not found');
        }

        return $this->sendResponse($files->toArray(), 'Files retrieved successfully');
    }

    /**
     * Update the specified Files in storage.
     * PUT/PATCH /files/{id}
     *
     * @param  int $id
     * @param UpdateFilesAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFilesAPIRequest $request)
    {
        $input = $request->all();

        /** @var Files $files */
        $files = $this->filesRepository->findWithoutFail($id);

        if (empty($files)) {
            return $this->sendError('Files not found');
        }

        $files = $this->filesRepository->update($input, $id);

        return $this->sendResponse($files->toArray(), 'Files updated successfully');
    }

    /**
     * Remove the specified Files from storage.
     * DELETE /files/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Files $files */
        $files = $this->filesRepository->findWithoutFail($id);

        if (empty($files)) {
            return $this->sendError('Files not found');
        }

        $files->delete();

        return $this->sendResponse($id, 'Files deleted successfully');
    }
}
