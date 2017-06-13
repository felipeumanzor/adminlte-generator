<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSubjectAPIRequest;
use App\Http\Requests\API\UpdateSubjectAPIRequest;
use App\Models\Subject;
use App\Repositories\SubjectRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class SubjectController
 * @package App\Http\Controllers\API
 */

class SubjectAPIController extends AppBaseController
{
    /** @var  SubjectRepository */
    private $subjectRepository;

    public function __construct(SubjectRepository $subjectRepo)
    {
        $this->subjectRepository = $subjectRepo;
    }

    /**
     * Display a listing of the Subject.
     * GET|HEAD /subjects
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->subjectRepository->pushCriteria(new RequestCriteria($request));
        $this->subjectRepository->pushCriteria(new LimitOffsetCriteria($request));
        $subjects = $this->subjectRepository->all();

        return $this->sendResponse($subjects->toArray(), 'Subjects retrieved successfully');
    }

    /**
     * Store a newly created Subject in storage.
     * POST /subjects
     *
     * @param CreateSubjectAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSubjectAPIRequest $request)
    {
        $input = $request->all();

        $subjects = $this->subjectRepository->create($input);

        return $this->sendResponse($subjects->toArray(), 'Subject saved successfully');
    }

    /**
     * Display the specified Subject.
     * GET|HEAD /subjects/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Subject $subject */
        $subject = $this->subjectRepository->findWithoutFail($id);

        if (empty($subject)) {
            return $this->sendError('Subject not found');
        }

        return $this->sendResponse($subject->toArray(), 'Subject retrieved successfully');
    }

    /**
     * Update the specified Subject in storage.
     * PUT/PATCH /subjects/{id}
     *
     * @param  int $id
     * @param UpdateSubjectAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSubjectAPIRequest $request)
    {
        $input = $request->all();

        /** @var Subject $subject */
        $subject = $this->subjectRepository->findWithoutFail($id);

        if (empty($subject)) {
            return $this->sendError('Subject not found');
        }

        $subject = $this->subjectRepository->update($input, $id);

        return $this->sendResponse($subject->toArray(), 'Subject updated successfully');
    }

    /**
     * Remove the specified Subject from storage.
     * DELETE /subjects/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Subject $subject */
        $subject = $this->subjectRepository->findWithoutFail($id);

        if (empty($subject)) {
            return $this->sendError('Subject not found');
        }

        $subject->delete();

        return $this->sendResponse($id, 'Subject deleted successfully');
    }
}
