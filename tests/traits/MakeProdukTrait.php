<?php

use Faker\Factory as Faker;
use App\Models\Produk;
use App\Repositories\ProdukRepository;

trait MakeProdukTrait
{
    /**
     * Create fake instance of Produk and save it in database
     *
     * @param array $produkFields
     * @return Produk
     */
    public function makeProduk($produkFields = [])
    {
        /** @var ProdukRepository $produkRepo */
        $produkRepo = App::make(ProdukRepository::class);
        $theme = $this->fakeProdukData($produkFields);
        return $produkRepo->create($theme);
    }

    /**
     * Get fake instance of Produk
     *
     * @param array $produkFields
     * @return Produk
     */
    public function fakeProduk($produkFields = [])
    {
        return new Produk($this->fakeProdukData($produkFields));
    }

    /**
     * Get fake data of Produk
     *
     * @param array $postFields
     * @return array
     */
    public function fakeProdukData($produkFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama' => $fake->word,
            'deskripsi' => $fake->text,
            'stok' => $fake->randomDigitNotNull,
            'harga' => $fake->randomDigitNotNull,
            'idKategori' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $produkFields);
    }
}
