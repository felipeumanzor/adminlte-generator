<?php

namespace App\Http\Controllers;

use App\DataTables\ContentDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateContentRequest;
use App\Http\Requests\UpdateContentRequest;
use App\Repositories\ContentRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ContentController extends AppBaseController
{
    /** @var  ContentRepository */
    private $contentRepository;

    public function __construct(ContentRepository $contentRepo)
    {
        $this->contentRepository = $contentRepo;
    }

    /**
     * Display a listing of the Content.
     *
     * @param ContentDataTable $contentDataTable
     * @return Response
     */
    public function index(ContentDataTable $contentDataTable)
    {
        return $contentDataTable->render('contents.index');
    }

    /**
     * Show the form for creating a new Content.
     *
     * @return Response
     */
    public function create()
    {

        $levels = \App\Models\Level::with('subjects')->get();

        return view('contents.create')->with('levels',$levels);
    }

    /**
     * Store a newly created Content in storage.
     *
     * @param CreateContentRequest $request
     *
     * @return Response
     */
    public function store(CreateContentRequest $request)
    {
        $input = $request->all();

        $content = $this->contentRepository->create($input);

        Flash::success('Content saved successfully.');

        return redirect(route('contents.index'));
    }

    /**
     * Display the specified Content.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $content = $this->contentRepository->findWithoutFail($id);

        if (empty($content)) {
            Flash::error('Content not found');

            return redirect(route('contents.index'));
        }

        return view('contents.show')->with('content', $content);
    }

    /**
     * Show the form for editing the specified Content.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $content = $this->contentRepository->findWithoutFail($id);
        $levels = \App\Models\Level::with('subjects')->get();

        if (empty($content)) {
            Flash::error('Content not found');

            return redirect(route('contents.index'));
        }

        return view('contents.edit')->with(array('content'=>$content, 'levels'=>$levels));
    }

    /**
     * Update the specified Content in storage.
     *
     * @param  int              $id
     * @param UpdateContentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateContentRequest $request)
    {
        $content = $this->contentRepository->findWithoutFail($id);

        if (empty($content)) {
            Flash::error('Content not found');

            return redirect(route('contents.index'));
        }

        $content = $this->contentRepository->update($request->all(), $id);

        Flash::success('Content updated successfully.');

        return redirect(route('contents.index'));
    }

    /**
     * Remove the specified Content from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $content = $this->contentRepository->findWithoutFail($id);

        if (empty($content)) {
            Flash::error('Content not found');

            return redirect(route('contents.index'));
        }

        $this->contentRepository->delete($id);

        Flash::success('Content deleted successfully.');

        return redirect(route('contents.index'));
    }
}
