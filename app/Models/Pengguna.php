<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @SWG\Definition(
 *      definition="Pengguna",
 *      required={"name"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="email",
 *          description="email",
 *          type="string"
 *      ),
 *  *      @SWG\Property(
 *          property="jeniskelamin",
 *          description="jeniskelamin",
 *          type="string"
 *      ),
 *       @SWG\Property(
 *          property="notelepon",
 *          description="notelepon",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="foto",
 *          description="foto",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="urlfoto",
 *          description="urlfoto",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="password",
 *          description="password",
 *          type="string"
 *      ),
 * *       @SWG\Property(
 *          property="idHakakses",
 *          description="idHakakses",
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
class Pengguna extends Authenticatable
{
    use Notifiable;

    public $table = 'pengguna';
    

    // protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'email',
        'jeniskelamin',
        'notelepon',
        'foto',
        'urlfoto',
        'password',
        'idHakakses'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'jeniskelamin'=>'string',
        'notelepon'=>'integer',
        'foto'=>'string',
        'urlfoto'=>'string',
        'password' => 'string',
        'idHakakases'=>'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
   
    ];

    
}
