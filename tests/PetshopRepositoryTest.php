<?php

use App\Models\Petshop;
use App\Repositories\PetshopRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PetshopRepositoryTest extends TestCase
{
    use MakePetshopTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PetshopRepository
     */
    protected $petshopRepo;

    public function setUp()
    {
        parent::setUp();
        $this->petshopRepo = App::make(PetshopRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePetshop()
    {
        $petshop = $this->fakePetshopData();
        $createdPetshop = $this->petshopRepo->create($petshop);
        $createdPetshop = $createdPetshop->toArray();
        $this->assertArrayHasKey('id', $createdPetshop);
        $this->assertNotNull($createdPetshop['id'], 'Created Petshop must have id specified');
        $this->assertNotNull(Petshop::find($createdPetshop['id']), 'Petshop with given id must be in DB');
        $this->assertModelData($petshop, $createdPetshop);
    }

    /**
     * @test read
     */
    public function testReadPetshop()
    {
        $petshop = $this->makePetshop();
        $dbPetshop = $this->petshopRepo->find($petshop->id);
        $dbPetshop = $dbPetshop->toArray();
        $this->assertModelData($petshop->toArray(), $dbPetshop);
    }

    /**
     * @test update
     */
    public function testUpdatePetshop()
    {
        $petshop = $this->makePetshop();
        $fakePetshop = $this->fakePetshopData();
        $updatedPetshop = $this->petshopRepo->update($fakePetshop, $petshop->id);
        $this->assertModelData($fakePetshop, $updatedPetshop->toArray());
        $dbPetshop = $this->petshopRepo->find($petshop->id);
        $this->assertModelData($fakePetshop, $dbPetshop->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePetshop()
    {
        $petshop = $this->makePetshop();
        $resp = $this->petshopRepo->delete($petshop->id);
        $this->assertTrue($resp);
        $this->assertNull(Petshop::find($petshop->id), 'Petshop should not exist in DB');
    }
}
