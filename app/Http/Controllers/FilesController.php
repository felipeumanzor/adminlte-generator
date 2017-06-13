<?php

namespace App\Http\Controllers;

use App\DataTables\FilesDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateFilesRequest;
use App\Http\Requests\UpdateFilesRequest;
use App\Repositories\FilesRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class FilesController extends AppBaseController
{
    /** @var  FilesRepository */
    private $filesRepository;

    public function __construct(FilesRepository $filesRepo)
    {
        $this->filesRepository = $filesRepo;
    }

    /**
     * Display a listing of the Files.
     *
     * @param FilesDataTable $filesDataTable
     * @return Response
     */
    public function index(FilesDataTable $filesDataTable)
    {
        return $filesDataTable->render('files.index');
    }

    /**
     * Show the form for creating a new Files.
     *
     * @return Response
     */
    public function create()
    {
        return view('files.create');
    }

    /**
     * Store a newly created Files in storage.
     *
     * @param CreateFilesRequest $request
     *
     * @return Response
     */
    public function store(CreateFilesRequest $request)
    {
        $input = $request->all();

        $files = $this->filesRepository->create($input);

        Flash::success('Files saved successfully.');

        return redirect(route('files.index'));
    }

    /**
     * Display the specified Files.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $files = $this->filesRepository->findWithoutFail($id);

        if (empty($files)) {
            Flash::error('Files not found');

            return redirect(route('files.index'));
        }

        return view('files.show')->with('files', $files);
    }

    /**
     * Show the form for editing the specified Files.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $files = $this->filesRepository->findWithoutFail($id);

        if (empty($files)) {
            Flash::error('Files not found');

            return redirect(route('files.index'));
        }

        return view('files.edit')->with('files', $files);
    }

    /**
     * Update the specified Files in storage.
     *
     * @param  int              $id
     * @param UpdateFilesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFilesRequest $request)
    {
        $files = $this->filesRepository->findWithoutFail($id);

        if (empty($files)) {
            Flash::error('Files not found');

            return redirect(route('files.index'));
        }

        $files = $this->filesRepository->update($request->all(), $id);

        Flash::success('Files updated successfully.');

        return redirect(route('files.index'));
    }

    /**
     * Remove the specified Files from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $files = $this->filesRepository->findWithoutFail($id);

        if (empty($files)) {
            Flash::error('Files not found');

            return redirect(route('files.index'));
        }

        $this->filesRepository->delete($id);

        Flash::success('Files deleted successfully.');

        return redirect(route('files.index'));
    }
}
