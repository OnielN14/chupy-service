<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProdukAPIRequest;
use App\Http\Requests\API\UpdateProdukAPIRequest;
use App\Models\Produk;
use App\Repositories\ProdukRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ProdukController
 * @package App\Http\Controllers\API
 */

class ProdukAPIController extends AppBaseController
{
    /** @var  ProdukRepository */
    private $produkRepository;

    public function __construct(ProdukRepository $produkRepo)
    {
        $this->produkRepository = $produkRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/produks",
     *      summary="Get a listing of the Produks.",
     *      tags={"Produk"},
     *      description="Get all Produks",
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
     *                  @SWG\Items(ref="#/definitions/Produk")
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
        $this->produkRepository->pushCriteria(new RequestCriteria($request));
        $this->produkRepository->pushCriteria(new LimitOffsetCriteria($request));
        $produks = $this->produkRepository->all();

        return $this->sendResponse($produks->toArray(), 'Produks retrieved successfully');
    }

    /**
     * @param CreateProdukAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/produks",
     *      summary="Store a newly created Produk in storage",
     *      tags={"Produk"},
     *      description="Store Produk",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Produk that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Produk")
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
     *                  ref="#/definitions/Produk"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateProdukAPIRequest $request)
    {
        $input = $request->all();

        $produks = $this->produkRepository->create($input);

        return $this->sendResponse($produks->toArray(), 'Produk saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/produks/{id}",
     *      summary="Display the specified Produk",
     *      tags={"Produk"},
     *      description="Get Produk",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Produk",
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
     *                  ref="#/definitions/Produk"
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
        /** @var Produk $produk */
        $produk = $this->produkRepository->findWithoutFail($id);

        if (empty($produk)) {
            return $this->sendError('Produk not found');
        }

        return $this->sendResponse($produk->toArray(), 'Produk retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateProdukAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/produks/{id}",
     *      summary="Update the specified Produk in storage",
     *      tags={"Produk"},
     *      description="Update Produk",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Produk",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Produk that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Produk")
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
     *                  ref="#/definitions/Produk"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateProdukAPIRequest $request)
    {
        $input = $request->all();

        /** @var Produk $produk */
        $produk = $this->produkRepository->findWithoutFail($id);

        if (empty($produk)) {
            return $this->sendError('Produk not found');
        }

        $produk = $this->produkRepository->update($input, $id);

        return $this->sendResponse($produk->toArray(), 'Produk updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/produks/{id}",
     *      summary="Remove the specified Produk from storage",
     *      tags={"Produk"},
     *      description="Delete Produk",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Produk",
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
        /** @var Produk $produk */
        $produk = $this->produkRepository->findWithoutFail($id);

        if (empty($produk)) {
            return $this->sendError('Produk not found');
        }

        $produk->delete();

        return $this->sendResponse($id, 'Produk deleted successfully');
    }
}
