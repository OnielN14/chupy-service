<?php

namespace App\Repositories;

use App\Models\TagKonten;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class TagKontenRepository
 * @package App\Repositories
 * @version July 20, 2018, 2:42 am UTC
 *
 * @method TagKonten findWithoutFail($id, $columns = ['*'])
 * @method TagKonten find($id, $columns = ['*'])
 * @method TagKonten first($columns = ['*'])
*/
class TagKontenRepository extends BaseRepository
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
        return TagKonten::class;
    }
}
