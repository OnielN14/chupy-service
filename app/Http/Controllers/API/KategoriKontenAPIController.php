<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateKategoriKontenAPIRequest;
use App\Http\Requests\API\UpdateKategoriKontenAPIRequest;
use App\Models\KategoriKonten;
use App\Repositories\KategoriKontenRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class KategoriKontenController
 * @package App\Http\Controllers\API
 */

class KategoriKontenAPIController extends AppBaseController
{
    /** @var  KategoriKontenRepository */
    private $kategoriKontenRepository;

    public function __construct(KategoriKontenRepository $kategoriKontenRepo)
    {
        $this->kategoriKontenRepository = $kategoriKontenRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/kategoriKontens",
     *      summary="Get a listing of the KategoriKontens.",
     *      tags={"KategoriKonten"},
     *      description="Get all KategoriKontens",
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
     *                  @SWG\Items(ref="#/definitions/KategoriKonten")
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
        $this->kategoriKontenRepository->pushCriteria(new RequestCriteria($request));
        $this->kategoriKontenRepository->pushCriteria(new LimitOffsetCriteria($request));
        $kategoriKontens = $this->kategoriKontenRepository->all();

        return $this->sendResponse($kategoriKontens->toArray(), 'Kategori Kontens retrieved successfully');
    }

    /**
     * @param CreateKategoriKontenAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/kategoriKontens",
     *      summary="Store a newly created KategoriKonten in storage",
     *      tags={"KategoriKonten"},
     *      description="Store KategoriKonten",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="KategoriKonten that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/KategoriKonten")
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
     *                  ref="#/definitions/KategoriKonten"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateKategoriKontenAPIRequest $request)
    {
        $input = $request->all();

        $kategoriKontens = $this->kategoriKontenRepository->create($input);

        return $this->sendResponse($kategoriKontens->toArray(), 'Kategori Konten saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/kategoriKontens/{id}",
     *      summary="Display the specified KategoriKonten",
     *      tags={"KategoriKonten"},
     *      description="Get KategoriKonten",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of KategoriKonten",
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
     *                  ref="#/definitions/KategoriKonten"
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
        /** @var KategoriKonten $kategoriKonten */
        $kategoriKonten = $this->kategoriKontenRepository->findWithoutFail($id);

        if (empty($kategoriKonten)) {
            return $this->sendError('Kategori Konten not found');
        }

        return $this->sendResponse($kategoriKonten->toArray(), 'Kategori Konten retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateKategoriKontenAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/kategoriKontens/{id}",
     *      summary="Update the specified KategoriKonten in storage",
     *      tags={"KategoriKonten"},
     *      description="Update KategoriKonten",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of KategoriKonten",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="KategoriKonten that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/KategoriKonten")
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
     *                  ref="#/definitions/KategoriKonten"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateKategoriKontenAPIRequest $request)
    {
        $input = $request->all();

        /** @var KategoriKonten $kategoriKonten */
        $kategoriKonten = $this->kategoriKontenRepository->findWithoutFail($id);

        if (empty($kategoriKonten)) {
            return $this->sendError('Kategori Konten not found');
        }

        $kategoriKonten = $this->kategoriKontenRepository->update($input, $id);

        return $this->sendResponse($kategoriKonten->toArray(), 'KategoriKonten updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/kategoriKontens/{id}",
     *      summary="Remove the specified KategoriKonten from storage",
     *      tags={"KategoriKonten"},
     *      description="Delete KategoriKonten",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of KategoriKonten",
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
        /** @var KategoriKonten $kategoriKonten */
        $kategoriKonten = $this->kategoriKontenRepository->findWithoutFail($id);

        if (empty($kategoriKonten)) {
            return $this->sendError('Kategori Konten not found');
        }

        $kategoriKonten->delete();

        return $this->sendResponse($id, 'Kategori Konten deleted successfully');
    }
}
