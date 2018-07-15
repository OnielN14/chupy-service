<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Map",
 *      required={"nama", "deskripsi", "longitude", "latitude", "foto", "url_foto"},
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
 *          property="longitude",
 *          description="longitude",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="latitude",
 *          description="latitude",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="foto",
 *          description="foto",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="url_foto",
 *          description="url_foto",
 *          type="string"
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
class Map extends Model
{
    // use SoftDeletes;

    public $table = 'map';
    

    // protected $dates = ['deleted_at'];


    public $fillable = [
        'nama',
        'deskripsi',
        'longitude',
        'latitude',
        'foto',
        'url_foto'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nama' => 'string',
        'deskripsi' => 'string',
        'longitude' => 'string',
        'latitude' => 'string',
        'foto' => 'string',
        'url_foto' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nama' => 'required',
        'deskripsi' => 'required',
        'longitude' => 'required',
        'latitude' => 'required',
        'foto' => 'required',
        'url_foto' => 'required'
    ];

    
}
