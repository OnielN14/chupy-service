<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePetshopRequest;
use App\Http\Requests\UpdatePetshopRequest;
use App\Repositories\PetshopRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class PetshopController extends AppBaseController
{
    /** @var  PetshopRepository */
    private $petshopRepository;

    public function __construct(PetshopRepository $petshopRepo)
    {
        $this->petshopRepository = $petshopRepo;
    }

    /**
     * Display a listing of the Petshop.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->petshopRepository->pushCriteria(new RequestCriteria($request));
        $petshops = $this->petshopRepository->all();

        return view('petshops.index')
            ->with('petshops', $petshops);
    }

    /**
     * Show the form for creating a new Petshop.
     *
     * @return Response
     */
    public function create()
    {
        return view('petshops.create');
    }

    /**
     * Store a newly created Petshop in storage.
     *
     * @param CreatePetshopRequest $request
     *
     * @return Response
     */
    public function store(CreatePetshopRequest $request)
    {
        $input = $request->all();

        $petshop = $this->petshopRepository->create($input);

        Flash::success('Petshop saved successfully.');

        return redirect(route('petshops.index'));
    }

    /**
     * Display the specified Petshop.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $petshop = $this->petshopRepository->findWithoutFail($id);

        if (empty($petshop)) {
            Flash::error('Petshop not found');

            return redirect(route('petshops.index'));
        }

        return view('petshops.show')->with('petshop', $petshop);
    }

    /**
     * Show the form for editing the specified Petshop.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $petshop = $this->petshopRepository->findWithoutFail($id);

        if (empty($petshop)) {
            Flash::error('Petshop not found');

            return redirect(route('petshops.index'));
        }

        return view('petshops.edit')->with('petshop', $petshop);
    }

    /**
     * Update the specified Petshop in storage.
     *
     * @param  int              $id
     * @param UpdatePetshopRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePetshopRequest $request)
    {
        $petshop = $this->petshopRepository->findWithoutFail($id);

        if (empty($petshop)) {
            Flash::error('Petshop not found');

            return redirect(route('petshops.index'));
        }

        $petshop = $this->petshopRepository->update($request->all(), $id);

        Flash::success('Petshop updated successfully.');

        return redirect(route('petshops.index'));
    }

    /**
     * Remove the specified Petshop from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $petshop = $this->petshopRepository->findWithoutFail($id);

        if (empty($petshop)) {
            Flash::error('Petshop not found');

            return redirect(route('petshops.index'));
        }

        $this->petshopRepository->delete($id);

        Flash::success('Petshop deleted successfully.');

        return redirect(route('petshops.index'));
    }
}
