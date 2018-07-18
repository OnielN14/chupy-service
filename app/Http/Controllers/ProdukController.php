<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProdukRequest;
use App\Http\Requests\UpdateProdukRequest;
use App\Repositories\ProdukRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ProdukController extends AppBaseController
{
    /** @var  ProdukRepository */
    private $produkRepository;

    public function __construct(ProdukRepository $produkRepo)
    {
        $this->produkRepository = $produkRepo;
    }

    /**
     * Display a listing of the Produk.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->produkRepository->pushCriteria(new RequestCriteria($request));
        $produks = $this->produkRepository->all();

        return view('produks.index')
            ->with('produks', $produks);
    }

    /**
     * Show the form for creating a new Produk.
     *
     * @return Response
     */
    public function create()
    {
        return view('produks.create');
    }

    /**
     * Store a newly created Produk in storage.
     *
     * @param CreateProdukRequest $request
     *
     * @return Response
     */
    public function store(CreateProdukRequest $request)
    {
        $input = $request->all();

        $produk = $this->produkRepository->create($input);

        Flash::success('Produk saved successfully.');

        return redirect(route('produks.index'));
    }

    /**
     * Display the specified Produk.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $produk = $this->produkRepository->findWithoutFail($id);

        if (empty($produk)) {
            Flash::error('Produk not found');

            return redirect(route('produks.index'));
        }

        return view('produks.show')->with('produk', $produk);
    }

    /**
     * Show the form for editing the specified Produk.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $produk = $this->produkRepository->findWithoutFail($id);

        if (empty($produk)) {
            Flash::error('Produk not found');

            return redirect(route('produks.index'));
        }

        return view('produks.edit')->with('produk', $produk);
    }

    /**
     * Update the specified Produk in storage.
     *
     * @param  int              $id
     * @param UpdateProdukRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProdukRequest $request)
    {
        $produk = $this->produkRepository->findWithoutFail($id);

        if (empty($produk)) {
            Flash::error('Produk not found');

            return redirect(route('produks.index'));
        }

        $produk = $this->produkRepository->update($request->all(), $id);

        Flash::success('Produk updated successfully.');

        return redirect(route('produks.index'));
    }

    /**
     * Remove the specified Produk from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $produk = $this->produkRepository->findWithoutFail($id);

        if (empty($produk)) {
            Flash::error('Produk not found');

            return redirect(route('produks.index'));
        }

        $this->produkRepository->delete($id);

        Flash::success('Produk deleted successfully.');

        return redirect(route('produks.index'));
    }
}
