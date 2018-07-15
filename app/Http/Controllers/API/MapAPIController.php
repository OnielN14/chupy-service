<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMapAPIRequest;
use App\Http\Requests\API\UpdateMapAPIRequest;
use App\Models\Map;
use App\Repositories\MapRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class MapController
 * @package App\Http\Controllers\API
 */

class MapAPIController extends AppBaseController
{
    /** @var  MapRepository */
    private $mapRepository;

    public function __construct(MapRepository $mapRepo)
    {
        $this->mapRepository = $mapRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/maps",
     *      summary="Get a listing of the Maps.",
     *      tags={"Map"},
     *      description="Get all Maps",
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
     *                  @SWG\Items(ref="#/definitions/Map")
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
        $this->mapRepository->pushCriteria(new RequestCriteria($request));
        $this->mapRepository->pushCriteria(new LimitOffsetCriteria($request));
        $maps = $this->mapRepository->all();

        return $this->sendResponse($maps->toArray(), 'Maps retrieved successfully');
    }

    /**
     * @param CreateMapAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/maps",
     *      summary="Store a newly created Map in storage",
     *      tags={"Map"},
     *      description="Store Map",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Map that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Map")
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
     *                  ref="#/definitions/Map"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMapAPIRequest $request)
    {
        $input = $request->all();

        $maps = $this->mapRepository->create($input);

        return $this->sendResponse($maps->toArray(), 'Map saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/maps/{id}",
     *      summary="Display the specified Map",
     *      tags={"Map"},
     *      description="Get Map",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Map",
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
     *                  ref="#/definitions/Map"
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
        /** @var Map $map */
        $map = $this->mapRepository->findWithoutFail($id);

        if (empty($map)) {
            return $this->sendError('Map not found');
        }

        return $this->sendResponse($map->toArray(), 'Map retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateMapAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/maps/{id}",
     *      summary="Update the specified Map in storage",
     *      tags={"Map"},
     *      description="Update Map",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Map",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Map that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Map")
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
     *                  ref="#/definitions/Map"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMapAPIRequest $request)
    {
        $input = $request->all();

        /** @var Map $map */
        $map = $this->mapRepository->findWithoutFail($id);

        if (empty($map)) {
            return $this->sendError('Map not found');
        }

        $map = $this->mapRepository->update($input, $id);

        return $this->sendResponse($map->toArray(), 'Map updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/maps/{id}",
     *      summary="Remove the specified Map from storage",
     *      tags={"Map"},
     *      description="Delete Map",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Map",
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
        /** @var Map $map */
        $map = $this->mapRepository->findWithoutFail($id);

        if (empty($map)) {
            return $this->sendError('Map not found');
        }

        $map->delete();

        return $this->sendResponse($id, 'Map deleted successfully');
    }
}
