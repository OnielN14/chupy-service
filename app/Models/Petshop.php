<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Petshop",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="nama",
 *          description="nama",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="deskripsi",
 *          description="deskripsi",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="alamat",
 *          description="alamat",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="idPengguna",
 *          description="idPengguna",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="idMap",
 *          description="idMap",
 *          type="integer",
 *          format="int32"
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
class Petshop extends Model
{
    // use SoftDeletes;

    public $table = 'petshop';
    

    // protected $dates = ['deleted_at'];


    public $fillable = [
        'id',
        'nama',
        'deskripsi',
        'alamat',
        'idPengguna',
        'idMap'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'=>'integer',
        'nama' => 'string',
        'deskripsi' => 'string',
        'alamat' => 'string',
        'idPengguna' => 'integer',
        'idMap' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
