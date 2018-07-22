<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateKontenAPIRequest;
use App\Http\Requests\API\UpdateKontenAPIRequest;
use App\Models\Konten;
use App\Models\TagKonten;
use App\Models\Tag;
use App\Repositories\KontenRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use DB;

/**
 * Class KontenController
 * @package App\Http\Controllers\API
 */

class KontenAPIController extends AppBaseController
{
    /** @var  KontenRepository */
    private $kontenRepository;

    public function __construct(KontenRepository $kontenRepo)
    {
        $this->kontenRepository = $kontenRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/kontens",
     *      summary="Get a listing of the Kontens.",
     *      tags={"Konten"},
     *      description="Get all Kontens",
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
     *                  @SWG\Items(ref="#/definitions/Konten")
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
        // $this->kontenRepository->pushCriteria(new RequestCriteria($request));
        // $this->kontenRepository->pushCriteria(new LimitOffsetCriteria($request));

        // $query = DB::table('konten')
        //             ->join('tagkonten','konten.id','=','tagkonten.idKonten')
        //             ->join('tag','tagkonten.idTag','=','tag.id')
        //             ->select('konten.id','judul','deskripsi','idKategori','tag.id','tag')
        //             ->get();
        // $fetchdata=[];
        $fetchdata = DB::table('konten')
                        ->join('kategorikonten','konten.idKategori','=','kategorikonten.id')
                        ->select('konten.id','konten.judul','konten.deskripsi','konten.idKategori','kategorikonten.kategori')
                        ->get();
        // dd($fetchdata);
        for ($i=0;$i <count($fetchdata);$i++)
        {
            $tagKonten =DB::table('konten')
                            ->join('tagkonten','konten.id','=','tagkonten.idKonten')
                            ->join('tag','tagkonten.idTag','=','tag.id')
                            ->select('tagkonten.idKonten','tag.tag')
                            ->get();
            dd($tagKonten);
            // $fetchdata[$i]['tag'] = $tagKonten;
        }

        // $data = [
        //     "count" =>count($fetchdata),
        //     "data" => $fetchdata
        //   ];
        // $kontens = $this->kontenRepository->all();
        // $kontens = Konten::join('TagKonten','Konten.id','=','TagKonten.idKonten')
        //                 ->join('Tag','TagKonten.idTag','=','Tag.id')->get();
        // dd($kontens);

        return $this->sendResponse($kontens->toArray(), 'Kontens retrieved successfully');
    }

    /**
     * @param CreateKontenAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/kontens",
     *      summary="Store a newly created Konten in storage",
     *      tags={"Konten"},
     *      description="Store Konten",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Konten that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Konten")
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
     *                  ref="#/definitions/Konten"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateKontenAPIRequest $request)
    {
        $input = $request->all();

        $kontens = $this->kontenRepository->create($input);

        return $this->sendResponse($kontens->toArray(), 'Konten saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/kontens/{id}",
     *      summary="Display the specified Konten",
     *      tags={"Konten"},
     *      description="Get Konten",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Konten",
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
     *                  ref="#/definitions/Konten"
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
        /** @var Konten $konten */
        $konten = $this->kontenRepository->findWithoutFail($id);

        if (empty($konten)) {
            return $this->sendError('Konten not found');
        }

        return $this->sendResponse($konten->toArray(), 'Konten retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateKontenAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/kontens/{id}",
     *      summary="Update the specified Konten in storage",
     *      tags={"Konten"},
     *      description="Update Konten",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Konten",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Konten that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Konten")
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
     *                  ref="#/definitions/Konten"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateKontenAPIRequest $request)
    {
        $input = $request->all();

        /** @var Konten $konten */
        $konten = $this->kontenRepository->findWithoutFail($id);

        if (empty($konten)) {
            return $this->sendError('Konten not found');
        }

        $konten = $this->kontenRepository->update($input, $id);

        return $this->sendResponse($konten->toArray(), 'Konten updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/kontens/{id}",
     *      summary="Remove the specified Konten from storage",
     *      tags={"Konten"},
     *      description="Delete Konten",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Konten",
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
        /** @var Konten $konten */
        $konten = $this->kontenRepository->findWithoutFail($id);

        if (empty($konten)) {
            return $this->sendError('Konten not found');
        }

        $konten->delete();

        return $this->sendResponse($id, 'Konten deleted successfully');
    }
}
