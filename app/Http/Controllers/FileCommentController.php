<?php

namespace App\Http\Controllers;

use App\DataTables\FileCommentDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateFileCommentRequest;
use App\Http\Requests\UpdateFileCommentRequest;
use App\Repositories\FileCommentRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class FileCommentController extends AppBaseController
{
    /** @var  FileCommentRepository */
    private $fileCommentRepository;

    public function __construct(FileCommentRepository $fileCommentRepo)
    {
        $this->fileCommentRepository = $fileCommentRepo;
    }

    /**
     * Display a listing of the FileComment.
     *
     * @param FileCommentDataTable $fileCommentDataTable
     * @return Response
     */
    public function index(FileCommentDataTable $fileCommentDataTable)
    {
        return $fileCommentDataTable->render('file_comments.index');
    }

    /**
     * Show the form for creating a new FileComment.
     *
     * @return Response
     */
    public function create()
    {
        return view('file_comments.create');
    }

    /**
     * Store a newly created FileComment in storage.
     *
     * @param CreateFileCommentRequest $request
     *
     * @return Response
     */
    public function store(CreateFileCommentRequest $request)
    {
        $input = $request->all();

        $fileComment = $this->fileCommentRepository->create($input);

        Flash::success('File Comment saved successfully.');

        return redirect(route('fileComments.index'));
    }

    /**
     * Display the specified FileComment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $fileComment = $this->fileCommentRepository->findWithoutFail($id);

        if (empty($fileComment)) {
            Flash::error('File Comment not found');

            return redirect(route('fileComments.index'));
        }

        return view('file_comments.show')->with('fileComment', $fileComment);
    }

    /**
     * Show the form for editing the specified FileComment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $fileComment = $this->fileCommentRepository->findWithoutFail($id);

        if (empty($fileComment)) {
            Flash::error('File Comment not found');

            return redirect(route('fileComments.index'));
        }

        return view('file_comments.edit')->with('fileComment', $fileComment);
    }

    /**
     * Update the specified FileComment in storage.
     *
     * @param  int              $id
     * @param UpdateFileCommentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFileCommentRequest $request)
    {
        $fileComment = $this->fileCommentRepository->findWithoutFail($id);

        if (empty($fileComment)) {
            Flash::error('File Comment not found');

            return redirect(route('fileComments.index'));
        }

        $fileComment = $this->fileCommentRepository->update($request->all(), $id);

        Flash::success('File Comment updated successfully.');

        return redirect(route('fileComments.index'));
    }

    /**
     * Remove the specified FileComment from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $fileComment = $this->fileCommentRepository->findWithoutFail($id);

        if (empty($fileComment)) {
            Flash::error('File Comment not found');

            return redirect(route('fileComments.index'));
        }

        $this->fileCommentRepository->delete($id);

        Flash::success('File Comment deleted successfully.');

        return redirect(route('fileComments.index'));
    }
}
