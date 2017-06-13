<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePlanificationAPIRequest;
use App\Http\Requests\API\UpdatePlanificationAPIRequest;
use App\Models\Planification;
use App\Repositories\PlanificationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PlanificationController
 * @package App\Http\Controllers\API
 */

class PlanificationAPIController extends AppBaseController
{
    /** @var  PlanificationRepository */
    private $planificationRepository;

    public function __construct(PlanificationRepository $planificationRepo)
    {
        $this->planificationRepository = $planificationRepo;
    }

    /**
     * Display a listing of the Planification.
     * GET|HEAD /planifications
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->planificationRepository->pushCriteria(new RequestCriteria($request));
        $this->planificationRepository->pushCriteria(new LimitOffsetCriteria($request));
        $planifications = $this->planificationRepository->all();

        return $this->sendResponse($planifications->toArray(), 'Planifications retrieved successfully');
    }

    /**
     * Store a newly created Planification in storage.
     * POST /planifications
     *
     * @param CreatePlanificationAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePlanificationAPIRequest $request)
    {
        $input = $request->all();

        $planifications = $this->planificationRepository->create($input);

        return $this->sendResponse($planifications->toArray(), 'Planification saved successfully');
    }

    /**
     * Display the specified Planification.
     * GET|HEAD /planifications/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Planification $planification */
        $planification = $this->planificationRepository->findWithoutFail($id);

        if (empty($planification)) {
            return $this->sendError('Planification not found');
        }

        return $this->sendResponse($planification->toArray(), 'Planification retrieved successfully');
    }

    /**
     * Update the specified Planification in storage.
     * PUT/PATCH /planifications/{id}
     *
     * @param  int $id
     * @param UpdatePlanificationAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePlanificationAPIRequest $request)
    {
        $input = $request->all();

        /** @var Planification $planification */
        $planification = $this->planificationRepository->findWithoutFail($id);

        if (empty($planification)) {
            return $this->sendError('Planification not found');
        }

        $planification = $this->planificationRepository->update($input, $id);

        return $this->sendResponse($planification->toArray(), 'Planification updated successfully');
    }

    /**
     * Remove the specified Planification from storage.
     * DELETE /planifications/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Planification $planification */
        $planification = $this->planificationRepository->findWithoutFail($id);

        if (empty($planification)) {
            return $this->sendError('Planification not found');
        }

        $planification->delete();

        return $this->sendResponse($id, 'Planification deleted successfully');
    }
}
