<?php

use Faker\Factory as Faker;
use App\Models\Pengguna;
use App\Repositories\PenggunaRepository;

trait MakePenggunaTrait
{
    /**
     * Create fake instance of Pengguna and save it in database
     *
     * @param array $penggunaFields
     * @return Pengguna
     */
    public function makePengguna($penggunaFields = [])
    {
        /** @var PenggunaRepository $penggunaRepo */
        $penggunaRepo = App::make(PenggunaRepository::class);
        $theme = $this->fakePenggunaData($penggunaFields);
        return $penggunaRepo->create($theme);
    }

    /**
     * Get fake instance of Pengguna
     *
     * @param array $penggunaFields
     * @return Pengguna
     */
    public function fakePengguna($penggunaFields = [])
    {
        return new Pengguna($this->fakePenggunaData($penggunaFields));
    }

    /**
     * Get fake data of Pengguna
     *
     * @param array $postFields
     * @return array
     */
    public function fakePenggunaData($penggunaFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'email' => $fake->word,
            'password' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $penggunaFields);
    }
}
