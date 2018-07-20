<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PetshopApiTest extends TestCase
{
    use MakePetshopTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePetshop()
    {
        $petshop = $this->fakePetshopData();
        $this->json('POST', '/api/v1/petshops', $petshop);

        $this->assertApiResponse($petshop);
    }

    /**
     * @test
     */
    public function testReadPetshop()
    {
        $petshop = $this->makePetshop();
        $this->json('GET', '/api/v1/petshops/'.$petshop->id);

        $this->assertApiResponse($petshop->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePetshop()
    {
        $petshop = $this->makePetshop();
        $editedPetshop = $this->fakePetshopData();

        $this->json('PUT', '/api/v1/petshops/'.$petshop->id, $editedPetshop);

        $this->assertApiResponse($editedPetshop);
    }

    /**
     * @test
     */
    public function testDeletePetshop()
    {
        $petshop = $this->makePetshop();
        $this->json('DELETE', '/api/v1/petshops/'.$petshop->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/petshops/'.$petshop->id);

        $this->assertResponseStatus(404);
    }
}
