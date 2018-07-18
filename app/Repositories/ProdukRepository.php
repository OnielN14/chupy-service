<?php

namespace App\Repositories;

use App\Models\Produk;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProdukRepository
 * @package App\Repositories
 * @version July 18, 2018, 8:49 am UTC
 *
 * @method Produk findWithoutFail($id, $columns = ['*'])
 * @method Produk find($id, $columns = ['*'])
 * @method Produk first($columns = ['*'])
*/
class ProdukRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama',
        'deskripsi',
        'stok',
        'harga',
        'idKategori'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Produk::class;
    }
}
