<?php

namespace App\Repositories;

use App\Models\Pengguna;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PenggunaRepository
 * @package App\Repositories
 * @version July 15, 2018, 10:20 am UTC
 *
 * @method Pengguna findWithoutFail($id, $columns = ['*'])
 * @method Pengguna find($id, $columns = ['*'])
 * @method Pengguna first($columns = ['*'])
*/
class PenggunaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'password'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Pengguna::class;
    }
}
