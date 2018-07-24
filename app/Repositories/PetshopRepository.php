<?php

namespace App\Repositories;

use App\Models\Petshop;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PetshopRepository
 * @package App\Repositories
 * @version July 18, 2018, 10:27 am UTC
 *
 * @method Petshop findWithoutFail($id, $columns = ['*'])
 * @method Petshop find($id, $columns = ['*'])
 * @method Petshop first($columns = ['*'])
*/
class PetshopRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama',
        'deskripsi',
        'alamat',
        'idPengguna',
        'idMap'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Petshop::class;
    }
}
