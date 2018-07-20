<?php

use Faker\Factory as Faker;
use App\Models\TagKonten;
use App\Repositories\TagKontenRepository;

trait MakeTagKontenTrait
{
    /**
     * Create fake instance of TagKonten and save it in database
     *
     * @param array $tagKontenFields
     * @return TagKonten
     */
    public function makeTagKonten($tagKontenFields = [])
    {
        /** @var TagKontenRepository $tagKontenRepo */
        $tagKontenRepo = App::make(TagKontenRepository::class);
        $theme = $this->fakeTagKontenData($tagKontenFields);
        return $tagKontenRepo->create($theme);
    }

    /**
     * Get fake instance of TagKonten
     *
     * @param array $tagKontenFields
     * @return TagKonten
     */
    public function fakeTagKonten($tagKontenFields = [])
    {
        return new TagKonten($this->fakeTagKontenData($tagKontenFields));
    }

    /**
     * Get fake data of TagKonten
     *
     * @param array $postFields
     * @return array
     */
    public function fakeTagKontenData($tagKontenFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $tagKontenFields);
    }
}
