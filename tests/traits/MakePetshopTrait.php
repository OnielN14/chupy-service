<?php

use Faker\Factory as Faker;
use App\Models\Petshop;
use App\Repositories\PetshopRepository;

trait MakePetshopTrait
{
    /**
     * Create fake instance of Petshop and save it in database
     *
     * @param array $petshopFields
     * @return Petshop
     */
    public function makePetshop($petshopFields = [])
    {
        /** @var PetshopRepository $petshopRepo */
        $petshopRepo = App::make(PetshopRepository::class);
        $theme = $this->fakePetshopData($petshopFields);
        return $petshopRepo->create($theme);
    }

    /**
     * Get fake instance of Petshop
     *
     * @param array $petshopFields
     * @return Petshop
     */
    public function fakePetshop($petshopFields = [])
    {
        return new Petshop($this->fakePetshopData($petshopFields));
    }

    /**
     * Get fake data of Petshop
     *
     * @param array $postFields
     * @return array
     */
    public function fakePetshopData($petshopFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama' => $fake->word,
            'deskripsi' => $fake->text,
            'alamat' => $fake->text,
            'idPengguna' => $fake->randomDigitNotNull,
            'idMap' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $petshopFields);
    }
}
