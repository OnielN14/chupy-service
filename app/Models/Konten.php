<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Konten",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="judul",
 *          description="judul",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="deskripsi",
 *          description="deskripsi",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="idKategori",
 *          description="idKategori",
 *          type="integer",
 *          format="int32"
 *      ),
 *   @SWG\Property(
 *          property="kategori",
 *          description="kategori",
 *          type="string",
 *      ),
 *    @SWG\Property(
 *          property="foto",
 *          description="foto",
 *          type="string",
 *      ),
 *    @SWG\Property(
 *          property="tag",
 *          description="tag",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Konten extends Model
{
    // use SoftDeletes;

    public $table = 'konten';
    

    // protected $dates = ['deleted_at'];


    public $fillable = [
        'id',
        'judul',
        'deskripsi',
        'idKategori',
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'judul' => 'string',
        'deskripsi' => 'string',
        'idKategori' => 'integer',
    
    ];


    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
