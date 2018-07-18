<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateKontenRequest;
use App\Http\Requests\UpdateKontenRequest;
use App\Repositories\KontenRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class KontenController extends AppBaseController
{
    /** @var  KontenRepository */
    private $kontenRepository;

    public function __construct(KontenRepository $kontenRepo)
    {
        $this->kontenRepository = $kontenRepo;
    }

    /**
     * Display a listing of the Konten.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->kontenRepository->pushCriteria(new RequestCriteria($request));
        $kontens = $this->kontenRepository->all();

        return view('kontens.index')
            ->with('kontens', $kontens);
    }

    /**
     * Show the form for creating a new Konten.
     *
     * @return Response
     */
    public function create()
    {
        return view('kontens.create');
    }

    /**
     * Store a newly created Konten in storage.
     *
     * @param CreateKontenRequest $request
     *
     * @return Response
     */
    public function store(CreateKontenRequest $request)
    {
        $input = $request->all();

        $konten = $this->kontenRepository->create($input);

        Flash::success('Konten saved successfully.');

        return redirect(route('kontens.index'));
    }

    /**
     * Display the specified Konten.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $konten = $this->kontenRepository->findWithoutFail($id);

        if (empty($konten)) {
            Flash::error('Konten not found');

            return redirect(route('kontens.index'));
        }

        return view('kontens.show')->with('konten', $konten);
    }

    /**
     * Show the form for editing the specified Konten.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $konten = $this->kontenRepository->findWithoutFail($id);

        if (empty($konten)) {
            Flash::error('Konten not found');

            return redirect(route('kontens.index'));
        }

        return view('kontens.edit')->with('konten', $konten);
    }

    /**
     * Update the specified Konten in storage.
     *
     * @param  int              $id
     * @param UpdateKontenRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateKontenRequest $request)
    {
        $konten = $this->kontenRepository->findWithoutFail($id);

        if (empty($konten)) {
            Flash::error('Konten not found');

            return redirect(route('kontens.index'));
        }

        $konten = $this->kontenRepository->update($request->all(), $id);

        Flash::success('Konten updated successfully.');

        return redirect(route('kontens.index'));
    }

    /**
     * Remove the specified Konten from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $konten = $this->kontenRepository->findWithoutFail($id);

        if (empty($konten)) {
            Flash::error('Konten not found');

            return redirect(route('kontens.index'));
        }

        $this->kontenRepository->delete($id);

        Flash::success('Konten deleted successfully.');

        return redirect(route('kontens.index'));
    }
}
