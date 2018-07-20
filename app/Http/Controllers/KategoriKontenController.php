<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateKategoriKontenRequest;
use App\Http\Requests\UpdateKategoriKontenRequest;
use App\Repositories\KategoriKontenRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class KategoriKontenController extends AppBaseController
{
    /** @var  KategoriKontenRepository */
    private $kategoriKontenRepository;

    public function __construct(KategoriKontenRepository $kategoriKontenRepo)
    {
        $this->kategoriKontenRepository = $kategoriKontenRepo;
    }

    /**
     * Display a listing of the KategoriKonten.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->kategoriKontenRepository->pushCriteria(new RequestCriteria($request));
        $kategoriKontens = $this->kategoriKontenRepository->all();

        return view('kategori_kontens.index')
            ->with('kategoriKontens', $kategoriKontens);
    }

    /**
     * Show the form for creating a new KategoriKonten.
     *
     * @return Response
     */
    public function create()
    {
        return view('kategori_kontens.create');
    }

    /**
     * Store a newly created KategoriKonten in storage.
     *
     * @param CreateKategoriKontenRequest $request
     *
     * @return Response
     */
    public function store(CreateKategoriKontenRequest $request)
    {
        $input = $request->all();

        $kategoriKonten = $this->kategoriKontenRepository->create($input);

        Flash::success('Kategori Konten saved successfully.');

        return redirect(route('kategoriKontens.index'));
    }

    /**
     * Display the specified KategoriKonten.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $kategoriKonten = $this->kategoriKontenRepository->findWithoutFail($id);

        if (empty($kategoriKonten)) {
            Flash::error('Kategori Konten not found');

            return redirect(route('kategoriKontens.index'));
        }

        return view('kategori_kontens.show')->with('kategoriKonten', $kategoriKonten);
    }

    /**
     * Show the form for editing the specified KategoriKonten.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $kategoriKonten = $this->kategoriKontenRepository->findWithoutFail($id);

        if (empty($kategoriKonten)) {
            Flash::error('Kategori Konten not found');

            return redirect(route('kategoriKontens.index'));
        }

        return view('kategori_kontens.edit')->with('kategoriKonten', $kategoriKonten);
    }

    /**
     * Update the specified KategoriKonten in storage.
     *
     * @param  int              $id
     * @param UpdateKategoriKontenRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateKategoriKontenRequest $request)
    {
        $kategoriKonten = $this->kategoriKontenRepository->findWithoutFail($id);

        if (empty($kategoriKonten)) {
            Flash::error('Kategori Konten not found');

            return redirect(route('kategoriKontens.index'));
        }

        $kategoriKonten = $this->kategoriKontenRepository->update($request->all(), $id);

        Flash::success('Kategori Konten updated successfully.');

        return redirect(route('kategoriKontens.index'));
    }

    /**
     * Remove the specified KategoriKonten from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $kategoriKonten = $this->kategoriKontenRepository->findWithoutFail($id);

        if (empty($kategoriKonten)) {
            Flash::error('Kategori Konten not found');

            return redirect(route('kategoriKontens.index'));
        }

        $this->kategoriKontenRepository->delete($id);

        Flash::success('Kategori Konten deleted successfully.');

        return redirect(route('kategoriKontens.index'));
    }
}
