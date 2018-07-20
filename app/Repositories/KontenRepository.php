<?php

namespace App\Repositories;

use App\Models\Konten;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class KontenRepository
 * @package App\Repositories
 * @version July 18, 2018, 9:27 am UTC
 *
 * @method Konten findWithoutFail($id, $columns = ['*'])
 * @method Konten find($id, $columns = ['*'])
 * @method Konten first($columns = ['*'])
*/
class KontenRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'judul',
        'deskripsi',
        'idKategori',
        'idTag'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Konten::class;
    }
}
