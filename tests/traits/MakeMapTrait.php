<?php

use Faker\Factory as Faker;
use App\Models\Map;
use App\Repositories\MapRepository;

trait MakeMapTrait
{
    /**
     * Create fake instance of Map and save it in database
     *
     * @param array $mapFields
     * @return Map
     */
    public function makeMap($mapFields = [])
    {
        /** @var MapRepository $mapRepo */
        $mapRepo = App::make(MapRepository::class);
        $theme = $this->fakeMapData($mapFields);
        return $mapRepo->create($theme);
    }

    /**
     * Get fake instance of Map
     *
     * @param array $mapFields
     * @return Map
     */
    public function fakeMap($mapFields = [])
    {
        return new Map($this->fakeMapData($mapFields));
    }

    /**
     * Get fake data of Map
     *
     * @param array $postFields
     * @return array
     */
    public function fakeMapData($mapFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama' => $fake->word,
            'deskripsi' => $fake->text,
            'longitude' => $fake->word,
            'latitude' => $fake->word,
            'foto' => $fake->word,
            'url_foto' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $mapFields);
    }
}
