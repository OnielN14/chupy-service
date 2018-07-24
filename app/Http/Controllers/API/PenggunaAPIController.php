<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePenggunaAPIRequest;
use App\Http\Requests\API\UpdatePenggunaAPIRequest;
use App\Models\Pengguna;
use App\Repositories\PenggunaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PenggunaController
 * @package App\Http\Controllers\API
 */

class PenggunaAPIController extends AppBaseController
{
    /** @var  PenggunaRepository */
    private $penggunaRepository;

    public function __construct(PenggunaRepository $penggunaRepo)
    {
        $this->penggunaRepository = $penggunaRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/login",
     *      summary="Login to akses function",
     *      tags={"Pengguna"},
     *      description="Login to System",
     *      produces={"application/json"},
     *       @SWG\Parameter(
     *          name="email",
     *          description="email of User",
     *          type="string",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="password",
     *          description="password of User",
     *          type="string",
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
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Pengguna")
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
        
    }

    /**
     * @param CreatePenggunaAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/penggunas",
     *      summary="Store a newly created Pengguna in storage",
     *      tags={"Pengguna"},
     *      description="Store Pengguna",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Pengguna that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Pengguna")
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
     *                  ref="#/definitions/Pengguna"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePenggunaAPIRequest $request)
    {
        $input = $request->all();

        $penggunas = $this->penggunaRepository->create($input);

        return $this->sendResponse($penggunas->toArray(), 'Pengguna saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/penggunas/{id}",
     *      summary="Display the specified Pengguna",
     *      tags={"Pengguna"},
     *      description="Get Pengguna",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Pengguna",
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
     *                  ref="#/definitions/Pengguna"
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
        /** @var Pengguna $pengguna */
        $pengguna = $this->penggunaRepository->findWithoutFail($id);

        if (empty($pengguna)) {
            return $this->sendError('Pengguna not found');
        }

        return $this->sendResponse($pengguna->toArray(), 'Pengguna retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePenggunaAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/penggunas/{id}",
     *      summary="Update the specified Pengguna in storage",
     *      tags={"Pengguna"},
     *      description="Update Pengguna",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Pengguna",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Pengguna that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Pengguna")
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
     *                  ref="#/definitions/Pengguna"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePenggunaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Pengguna $pengguna */
        $pengguna = $this->penggunaRepository->findWithoutFail($id);

        if (empty($pengguna)) {
            return $this->sendError('Pengguna not found');
        }

        $pengguna = $this->penggunaRepository->update($input, $id);

        return $this->sendResponse($pengguna->toArray(), 'Pengguna updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/penggunas/{id}",
     *      summary="Remove the specified Pengguna from storage",
     *      tags={"Pengguna"},
     *      description="Delete Pengguna",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Pengguna",
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
        /** @var Pengguna $pengguna */
        $pengguna = $this->penggunaRepository->findWithoutFail($id);

        if (empty($pengguna)) {
            return $this->sendError('Pengguna not found');
        }

        $pengguna->delete();

        return $this->sendResponse($id, 'Pengguna deleted successfully');
    }
}
