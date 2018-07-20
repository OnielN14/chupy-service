<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTagKontenAPIRequest;
use App\Http\Requests\API\UpdateTagKontenAPIRequest;
use App\Models\TagKonten;
use App\Repositories\TagKontenRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class TagKontenController
 * @package App\Http\Controllers\API
 */

class TagKontenAPIController extends AppBaseController
{
    /** @var  TagKontenRepository */
    private $tagKontenRepository;

    public function __construct(TagKontenRepository $tagKontenRepo)
    {
        $this->tagKontenRepository = $tagKontenRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/tagKontens",
     *      summary="Get a listing of the TagKontens.",
     *      tags={"TagKonten"},
     *      description="Get all TagKontens",
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
     *                  @SWG\Items(ref="#/definitions/TagKonten")
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
        $this->tagKontenRepository->pushCriteria(new RequestCriteria($request));
        $this->tagKontenRepository->pushCriteria(new LimitOffsetCriteria($request));
        $tagKontens = $this->tagKontenRepository->all();

        return $this->sendResponse($tagKontens->toArray(), 'Tag Kontens retrieved successfully');
    }

    /**
     * @param CreateTagKontenAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/tagKontens",
     *      summary="Store a newly created TagKonten in storage",
     *      tags={"TagKonten"},
     *      description="Store TagKonten",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="TagKonten that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/TagKonten")
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
     *                  ref="#/definitions/TagKonten"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTagKontenAPIRequest $request)
    {
        $input = $request->all();

        $tagKontens = $this->tagKontenRepository->create($input);

        return $this->sendResponse($tagKontens->toArray(), 'Tag Konten saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/tagKontens/{id}",
     *      summary="Display the specified TagKonten",
     *      tags={"TagKonten"},
     *      description="Get TagKonten",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TagKonten",
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
     *                  ref="#/definitions/TagKonten"
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
        /** @var TagKonten $tagKonten */
        $tagKonten = $this->tagKontenRepository->findWithoutFail($id);

        if (empty($tagKonten)) {
            return $this->sendError('Tag Konten not found');
        }

        return $this->sendResponse($tagKonten->toArray(), 'Tag Konten retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateTagKontenAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/tagKontens/{id}",
     *      summary="Update the specified TagKonten in storage",
     *      tags={"TagKonten"},
     *      description="Update TagKonten",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TagKonten",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="TagKonten that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/TagKonten")
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
     *                  ref="#/definitions/TagKonten"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTagKontenAPIRequest $request)
    {
        $input = $request->all();

        /** @var TagKonten $tagKonten */
        $tagKonten = $this->tagKontenRepository->findWithoutFail($id);

        if (empty($tagKonten)) {
            return $this->sendError('Tag Konten not found');
        }

        $tagKonten = $this->tagKontenRepository->update($input, $id);

        return $this->sendResponse($tagKonten->toArray(), 'TagKonten updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/tagKontens/{id}",
     *      summary="Remove the specified TagKonten from storage",
     *      tags={"TagKonten"},
     *      description="Delete TagKonten",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TagKonten",
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
        /** @var TagKonten $tagKonten */
        $tagKonten = $this->tagKontenRepository->findWithoutFail($id);

        if (empty($tagKonten)) {
            return $this->sendError('Tag Konten not found');
        }

        $tagKonten->delete();

        return $this->sendResponse($id, 'Tag Konten deleted successfully');
    }
}
