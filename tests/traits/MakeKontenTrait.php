<?php

use Faker\Factory as Faker;
use App\Models\Konten;
use App\Repositories\KontenRepository;

trait MakeKontenTrait
{
    /**
     * Create fake instance of Konten and save it in database
     *
     * @param array $kontenFields
     * @return Konten
     */
    public function makeKonten($kontenFields = [])
    {
        /** @var KontenRepository $kontenRepo */
        $kontenRepo = App::make(KontenRepository::class);
        $theme = $this->fakeKontenData($kontenFields);
        return $kontenRepo->create($theme);
    }

    /**
     * Get fake instance of Konten
     *
     * @param array $kontenFields
     * @return Konten
     */
    public function fakeKonten($kontenFields = [])
    {
        return new Konten($this->fakeKontenData($kontenFields));
    }

    /**
     * Get fake data of Konten
     *
     * @param array $postFields
     * @return array
     */
    public function fakeKontenData($kontenFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'id' => $fake->randomDigitNotNull,
            'judul' => $fake->word,
            'deskripsi' => $fake->text,
            'idKategori' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $kontenFields);
    }
}
