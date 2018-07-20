<?php

use Faker\Factory as Faker;
use App\Models\KategoriKonten;
use App\Repositories\KategoriKontenRepository;

trait MakeKategoriKontenTrait
{
    /**
     * Create fake instance of KategoriKonten and save it in database
     *
     * @param array $kategoriKontenFields
     * @return KategoriKonten
     */
    public function makeKategoriKonten($kategoriKontenFields = [])
    {
        /** @var KategoriKontenRepository $kategoriKontenRepo */
        $kategoriKontenRepo = App::make(KategoriKontenRepository::class);
        $theme = $this->fakeKategoriKontenData($kategoriKontenFields);
        return $kategoriKontenRepo->create($theme);
    }

    /**
     * Get fake instance of KategoriKonten
     *
     * @param array $kategoriKontenFields
     * @return KategoriKonten
     */
    public function fakeKategoriKonten($kategoriKontenFields = [])
    {
        return new KategoriKonten($this->fakeKategoriKontenData($kategoriKontenFields));
    }

    /**
     * Get fake data of KategoriKonten
     *
     * @param array $postFields
     * @return array
     */
    public function fakeKategoriKontenData($kategoriKontenFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $kategoriKontenFields);
    }
}
