<?php

use App\Models\Pengguna;
use App\Repositories\PenggunaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PenggunaRepositoryTest extends TestCase
{
    use MakePenggunaTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PenggunaRepository
     */
    protected $penggunaRepo;

    public function setUp()
    {
        parent::setUp();
        $this->penggunaRepo = App::make(PenggunaRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePengguna()
    {
        $pengguna = $this->fakePenggunaData();
        $createdPengguna = $this->penggunaRepo->create($pengguna);
        $createdPengguna = $createdPengguna->toArray();
        $this->assertArrayHasKey('id', $createdPengguna);
        $this->assertNotNull($createdPengguna['id'], 'Created Pengguna must have id specified');
        $this->assertNotNull(Pengguna::find($createdPengguna['id']), 'Pengguna with given id must be in DB');
        $this->assertModelData($pengguna, $createdPengguna);
    }

    /**
     * @test read
     */
    public function testReadPengguna()
    {
        $pengguna = $this->makePengguna();
        $dbPengguna = $this->penggunaRepo->find($pengguna->id);
        $dbPengguna = $dbPengguna->toArray();
        $this->assertModelData($pengguna->toArray(), $dbPengguna);
    }

    /**
     * @test update
     */
    public function testUpdatePengguna()
    {
        $pengguna = $this->makePengguna();
        $fakePengguna = $this->fakePenggunaData();
        $updatedPengguna = $this->penggunaRepo->update($fakePengguna, $pengguna->id);
        $this->assertModelData($fakePengguna, $updatedPengguna->toArray());
        $dbPengguna = $this->penggunaRepo->find($pengguna->id);
        $this->assertModelData($fakePengguna, $dbPengguna->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePengguna()
    {
        $pengguna = $this->makePengguna();
        $resp = $this->penggunaRepo->delete($pengguna->id);
        $this->assertTrue($resp);
        $this->assertNull(Pengguna::find($pengguna->id), 'Pengguna should not exist in DB');
    }
}
