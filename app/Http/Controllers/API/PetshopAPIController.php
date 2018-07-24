<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePetshopAPIRequest;
use App\Http\Requests\API\UpdatePetshopAPIRequest;
use App\Models\Petshop;
use App\Repositories\PetshopRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use DB;
/**
 * Class PetshopController
 * @package App\Http\Controllers\API
 */

class PetshopAPIController extends AppBaseController
{
    /** @var  PetshopRepository */
    private $petshopRepository;

    public function __construct(PetshopRepository $petshopRepo)
    {
        $this->petshopRepository = $petshopRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/petshops",
     *      summary="Get a listing of the Petshops.",
     *      tags={"Petshop"},
     *      description="Get all Petshops",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Petshop")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        // $this->petshopRepository->pushCriteria(new RequestCriteria($request));
        // $this->petshopRepository->pushCriteria(new LimitOffsetCriteria($request));
        // $petshops = $this->petshopRepository->all();
        $fetchdata = DB::table('pengguna')
                ->join('petshop','petshop.idPengguna','=','pengguna.id')
                ->join('map','petshop.idMap','=','map.id')
                ->select('petshop.id','petshop.nama','petshop.deskripsi','petshop.alamat','petshop.foto','petshop.urlfoto','pengguna.name as pemilik','pengguna.jeniskelamin','petshop.idMap','map.longitude','map.latitude')
                ->get();
            $fetchdata = json_decode($fetchdata,true);


        return $this->sendResponse($fetchdata, 'Petshops retrieved successfully');
    }

    /**
     * @param CreatePetshopAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/petshops",
     *      summary="Store a newly created Petshop in storage",
     *      tags={"Petshop"},
     *      description="Store Petshop",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Petshop that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Petshop")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Petshop"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePetshopAPIRequest $request)
    {
        $input = $request->all();

        $petshops = $this->petshopRepository->create($input);

        return $this->sendResponse($petshops->toArray(), 'Petshop saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/petshops/{id}",
     *      summary="Display the specified Petshop",
     *      tags={"Petshop"},
     *      description="Get Petshop",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Petshop",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Petshop"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Petshop $petshop */
        $petshop = $this->petshopRepository->findWithoutFail($id);

        if (empty($petshop)) {
            return $this->sendError('Petshop not found');
        }

        return $this->sendResponse($petshop->toArray(), 'Petshop retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePetshopAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/petshops/{id}",
     *      summary="Update the specified Petshop in storage",
     *      tags={"Petshop"},
     *      description="Update Petshop",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Petshop",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Petshop that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Petshop")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Petshop"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePetshopAPIRequest $request)
    {
        $input = $request->all();

        /** @var Petshop $petshop */
        $petshop = $this->petshopRepository->findWithoutFail($id);

        if (empty($petshop)) {
            return $this->sendError('Petshop not found');
        }

        $petshop = $this->petshopRepository->update($input, $id);

        return $this->sendResponse($petshop->toArray(), 'Petshop updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/petshops/{id}",
     *      summary="Remove the specified Petshop from storage",
     *      tags={"Petshop"},
     *      description="Delete Petshop",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Petshop",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Petshop $petshop */
        $petshop = $this->petshopRepository->findWithoutFail($id);

        if (empty($petshop)) {
            return $this->sendError('Petshop not found');
        }

        $petshop->delete();

        return $this->sendResponse($id, 'Petshop deleted successfully');
    }
}
