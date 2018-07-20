<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTagKontenRequest;
use App\Http\Requests\UpdateTagKontenRequest;
use App\Repositories\TagKontenRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class TagKontenController extends AppBaseController
{
    /** @var  TagKontenRepository */
    private $tagKontenRepository;

    public function __construct(TagKontenRepository $tagKontenRepo)
    {
        $this->tagKontenRepository = $tagKontenRepo;
    }

    /**
     * Display a listing of the TagKonten.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->tagKontenRepository->pushCriteria(new RequestCriteria($request));
        $tagKontens = $this->tagKontenRepository->all();

        return view('tag_kontens.index')
            ->with('tagKontens', $tagKontens);
    }

    /**
     * Show the form for creating a new TagKonten.
     *
     * @return Response
     */
    public function create()
    {
        return view('tag_kontens.create');
    }

    /**
     * Store a newly created TagKonten in storage.
     *
     * @param CreateTagKontenRequest $request
     *
     * @return Response
     */
    public function store(CreateTagKontenRequest $request)
    {
        $input = $request->all();

        $tagKonten = $this->tagKontenRepository->create($input);

        Flash::success('Tag Konten saved successfully.');

        return redirect(route('tagKontens.index'));
    }

    /**
     * Display the specified TagKonten.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tagKonten = $this->tagKontenRepository->findWithoutFail($id);

        if (empty($tagKonten)) {
            Flash::error('Tag Konten not found');

            return redirect(route('tagKontens.index'));
        }

        return view('tag_kontens.show')->with('tagKonten', $tagKonten);
    }

    /**
     * Show the form for editing the specified TagKonten.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tagKonten = $this->tagKontenRepository->findWithoutFail($id);

        if (empty($tagKonten)) {
            Flash::error('Tag Konten not found');

            return redirect(route('tagKontens.index'));
        }

        return view('tag_kontens.edit')->with('tagKonten', $tagKonten);
    }

    /**
     * Update the specified TagKonten in storage.
     *
     * @param  int              $id
     * @param UpdateTagKontenRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTagKontenRequest $request)
    {
        $tagKonten = $this->tagKontenRepository->findWithoutFail($id);

        if (empty($tagKonten)) {
            Flash::error('Tag Konten not found');

            return redirect(route('tagKontens.index'));
        }

        $tagKonten = $this->tagKontenRepository->update($request->all(), $id);

        Flash::success('Tag Konten updated successfully.');

        return redirect(route('tagKontens.index'));
    }

    /**
     * Remove the specified TagKonten from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tagKonten = $this->tagKontenRepository->findWithoutFail($id);

        if (empty($tagKonten)) {
            Flash::error('Tag Konten not found');

            return redirect(route('tagKontens.index'));
        }

        $this->tagKontenRepository->delete($id);

        Flash::success('Tag Konten deleted successfully.');

        return redirect(route('tagKontens.index'));
    }
}
