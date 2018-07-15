<?php

namespace App\Repositories;

use App\Models\Map;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MapRepository
 * @package App\Repositories
 * @version July 15, 2018, 7:41 am UTC
 *
 * @method Map findWithoutFail($id, $columns = ['*'])
 * @method Map find($id, $columns = ['*'])
 * @method Map first($columns = ['*'])
*/
class MapRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama',
        'deskripsi',
        'longitude',
        'latitude',
        'foto',
        'url_foto'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Map::class;
    }
}
