<?php

namespace App\Http\Controllers;

use App\DataTables\ContentCommentDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateContentCommentRequest;
use App\Http\Requests\UpdateContentCommentRequest;
use App\Repositories\ContentCommentRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ContentCommentController extends AppBaseController
{
    /** @var  ContentCommentRepository */
    private $contentCommentRepository;

    public function __construct(ContentCommentRepository $contentCommentRepo)
    {
        $this->contentCommentRepository = $contentCommentRepo;
    }

    /**
     * Display a listing of the ContentComment.
     *
     * @param ContentCommentDataTable $contentCommentDataTable
     * @return Response
     */
    public function index(ContentCommentDataTable $contentCommentDataTable)
    {
        return $contentCommentDataTable->render('content_comments.index');
    }

    /**
     * Show the form for creating a new ContentComment.
     *
     * @return Response
     */
    public function create()
    {
        return view('content_comments.create');
    }

    /**
     * Store a newly created ContentComment in storage.
     *
     * @param CreateContentCommentRequest $request
     *
     * @return Response
     */
    public function store(CreateContentCommentRequest $request)
    {
        $input = $request->all();

        $contentComment = $this->contentCommentRepository->create($input);

        Flash::success('Content Comment saved successfully.');

        return redirect(route('contentComments.index'));
    }

    /**
     * Display the specified ContentComment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $contentComment = $this->contentCommentRepository->findWithoutFail($id);

        if (empty($contentComment)) {
            Flash::error('Content Comment not found');

            return redirect(route('contentComments.index'));
        }

        return view('content_comments.show')->with('contentComment', $contentComment);
    }

    /**
     * Show the form for editing the specified ContentComment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $contentComment = $this->contentCommentRepository->findWithoutFail($id);

        if (empty($contentComment)) {
            Flash::error('Content Comment not found');

            return redirect(route('contentComments.index'));
        }

        return view('content_comments.edit')->with('contentComment', $contentComment);
    }

    /**
     * Update the specified ContentComment in storage.
     *
     * @param  int              $id
     * @param UpdateContentCommentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateContentCommentRequest $request)
    {
        $contentComment = $this->contentCommentRepository->findWithoutFail($id);

        if (empty($contentComment)) {
            Flash::error('Content Comment not found');

            return redirect(route('contentComments.index'));
        }

        $contentComment = $this->contentCommentRepository->update($request->all(), $id);

        Flash::success('Content Comment updated successfully.');

        return redirect(route('contentComments.index'));
    }

    /**
     * Remove the specified ContentComment from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $contentComment = $this->contentCommentRepository->findWithoutFail($id);

        if (empty($contentComment)) {
            Flash::error('Content Comment not found');

            return redirect(route('contentComments.index'));
        }

        $this->contentCommentRepository->delete($id);

        Flash::success('Content Comment deleted successfully.');

        return redirect(route('contentComments.index'));
    }
}
