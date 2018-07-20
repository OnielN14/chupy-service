<?php

namespace App\Repositories;

use App\Models\KategoriKonten;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class KategoriKontenRepository
 * @package App\Repositories
 * @version July 20, 2018, 2:21 am UTC
 *
 * @method KategoriKonten findWithoutFail($id, $columns = ['*'])
 * @method KategoriKonten find($id, $columns = ['*'])
 * @method KategoriKonten first($columns = ['*'])
*/
class KategoriKontenRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return KategoriKonten::class;
    }
}
