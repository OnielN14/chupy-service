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
use Carbon\Carbon;

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
        // dd($request);
        // $this->kontenRepository->pushCriteria(new RequestCriteria($request));
        // $this->kontenRepository->pushCriteria(new LimitOffsetCriteria($request));

        $fetchdata = DB::table('konten')
                        ->join('kategorikonten','konten.idKategori','=','kategorikonten.id')
                        ->select('konten.id','konten.judul','konten.deskripsi','konten.idKategori','kategorikonten.kategori','konten.tanggalPost')
                        ->get();
        $fetchdata = json_decode($fetchdata,true);
        
        for ($i=0;$i <count($fetchdata);$i++)
        {
            $tagKonten =DB::table('konten')
                            ->join('tagkonten','konten.id','=','tagkonten.idKonten')
                            ->join('tag','tagkonten.idTag','=','tag.id')
                            ->where('tagkonten.idKonten','=',$fetchdata[$i]['id'])
                            ->select('tag.id','tag.tag')
                            ->get();
            $tagKonten = json_decode($tagKonten,true);

            $fotoKonten =DB::table('fotokonten')
                        ->join('konten','fotokonten.idKonten','=','konten.id')
                        ->where('fotokonten.idKonten','=',$fetchdata[$i]['id'])
                        ->select('fotokonten.id','fotokonten.foto')
                        ->get();
            $fotoKonten = json_decode($fotoKonten,true);
            // dd($fotoKonten);

            $fetchdata[$i]['foto'] = $fotoKonten;
            $fetchdata[$i]['tag'] = $tagKonten;
        
        }
    
        // $kontens = $this->kontenRepository->all();

        return $this->sendResponse($fetchdata, 'Kontens retrieved successfully');
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
        // $cek = $request->file('foto');
        // $cek = $cek->getClientOriginalName();
        // dd($cek);

        $_konten = new Konten();
        
        if ($request->hasFile('foto')) {
            $imageKonten  = $request->file('foto');
            $imageName =$imageKonten->getClientOriginalName();
            $imageKonten->move(public_path().'/storage/img/img_konten/',$imageName);
            $pathImage = '/storage/img/img_konten/'.$imageName;
            // dd($pathImage);
            
        }
    
        $kategoriKonten = strtolower($request->post('kategori'));
        $isKategori     = DB::table('kategorikonten')
                            ->where('kategori', '=', $kategoriKonten)
                            ->first();
                       
        if ($isKategori ==! null) {
            $idKategori = $isKategori->id;
        }


        $_konten->judul         = $request->post('judul');
        $_konten->deskripsi     = $request->post('deskripsi');
        $_konten->idKategori    = $idKategori;
        $_konten->statusPost    = $request->post('statusPost');
        $_konten->tanggalPost   = Carbon::now();
        $_konten->save();
        $idKonten =$_konten->id;

        DB::table('fotokonten')->insert([
            'foto'=>$pathImage,
            'idKonten'=>$idKonten
        ]);

        $list_tag = $request->post('tag');
        // dd($list_tag);
        foreach($list_tag as $tag)
        {
            $_tag = new Tag();
            $_tagKonten = new TagKonten();
            
            $isTag = Tag::where('tag', '=', strtolower($tag))->first();

            if ($isTag === null) {
               $_tag->tag = $tag;
               $_tag->save();
               $idTag = $_tag->id;
             }
             else{
                $idTag = $isTag->id;
             }

             $_tagKonten->idKonten  =$idKonten;
             $_tagKonten->idTag     =$idTag;
             $_tagKonten->save();
        }


        $data = [
            'judul'=>$_konten->judul,
            'deskripsi'=>$_konten->deskripsi,
            'kategori_artikel'=>$isKategori->kategori,
            'foto'=>$pathImage,
            'tag'=>$list_tag
        ];

        return $this->sendResponse($data, 'Konten saved successfully');
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
        // $konten = $this->kontenRepository->findWithoutFail($id);

        
        $fetchdata = DB::table('konten')
                        ->join('kategorikonten','konten.idKategori','=','kategorikonten.id')
                        ->where('konten.id','=',$id)
                        ->select('konten.id','konten.judul','konten.deskripsi','konten.idKategori','kategorikonten.kategori','konten.tanggalPost')
                        ->get();
        $fetchdata = json_decode($fetchdata,true);
        // dd($fetchdata);
        if (empty($fetchdata)) {
            return $this->sendError('Konten not found');
        }

        for ($i=0;$i <count($fetchdata);$i++)
        {
            $tagKonten =DB::table('konten')
                            ->join('tagkonten','konten.id','=','tagkonten.idKonten')
                            ->join('tag','tagkonten.idTag','=','tag.id')
                            ->where('tagkonten.idKonten','=',$id)
                            ->select('tag.id','tag.tag')
                            ->get();
            $tagKonten = json_decode($tagKonten,true);

            $fotoKonten =DB::table('fotokonten')
            ->join('konten','fotokonten.idKonten','=','konten.id')
            ->where('fotokonten.idKonten','=',$id)
            ->select('fotokonten.id','fotokonten.foto')
            ->get();

            $fotoKonten = json_decode($fotoKonten,true);

            $fetchdata[$i]['foto'] = $fotoKonten;
            $fetchdata[$i]['tag'] = $tagKonten;
        
        }
        // dd($fetchdata);
        return $this->sendResponse($fetchdata, 'Konten retrieved successfully');
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
        // $input = $request->all();

        // /** @var Konten $konten */
        // $konten = $this->kontenRepository->findWithoutFail($id);

        // if (empty($konten)) {
        //     return $this->sendError('Konten not found');
        // }

        // $konten = $this->kontenRepository->update($input, $id);

        // return $this->sendResponse($konten->toArray(), 'Konten updated successfully');
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

        $image = DB::table('fotokonten')->where('idKonten', $id)->first();
        $pathImage = public_path().$image->foto;
        DB::table('fotokonten')->where('idKonten', $id)->delete();

        DB::table('tagkonten')
            ->where('idKonten','=',$id)
            ->delete();
        $konten = $this->kontenRepository->findWithoutFail($id);

        if (empty($konten)) {
            return $this->sendError('Konten not found');
        }

        if (file_exists($pathImage)) {
            unlink($pathImage);
        }
        $konten->delete();

        return $this->sendResponse($id, 'Konten deleted successfully');
    }
}
