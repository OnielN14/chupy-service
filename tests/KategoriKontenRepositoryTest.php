<?php

use App\Models\KategoriKonten;
use App\Repositories\KategoriKontenRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class KategoriKontenRepositoryTest extends TestCase
{
    use MakeKategoriKontenTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var KategoriKontenRepository
     */
    protected $kategoriKontenRepo;

    public function setUp()
    {
        parent::setUp();
        $this->kategoriKontenRepo = App::make(KategoriKontenRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateKategoriKonten()
    {
        $kategoriKonten = $this->fakeKategoriKontenData();
        $createdKategoriKonten = $this->kategoriKontenRepo->create($kategoriKonten);
        $createdKategoriKonten = $createdKategoriKonten->toArray();
        $this->assertArrayHasKey('id', $createdKategoriKonten);
        $this->assertNotNull($createdKategoriKonten['id'], 'Created KategoriKonten must have id specified');
        $this->assertNotNull(KategoriKonten::find($createdKategoriKonten['id']), 'KategoriKonten with given id must be in DB');
        $this->assertModelData($kategoriKonten, $createdKategoriKonten);
    }

    /**
     * @test read
     */
    public function testReadKategoriKonten()
    {
        $kategoriKonten = $this->makeKategoriKonten();
        $dbKategoriKonten = $this->kategoriKontenRepo->find($kategoriKonten->id);
        $dbKategoriKonten = $dbKategoriKonten->toArray();
        $this->assertModelData($kategoriKonten->toArray(), $dbKategoriKonten);
    }

    /**
     * @test update
     */
    public function testUpdateKategoriKonten()
    {
        $kategoriKonten = $this->makeKategoriKonten();
        $fakeKategoriKonten = $this->fakeKategoriKontenData();
        $updatedKategoriKonten = $this->kategoriKontenRepo->update($fakeKategoriKonten, $kategoriKonten->id);
        $this->assertModelData($fakeKategoriKonten, $updatedKategoriKonten->toArray());
        $dbKategoriKonten = $this->kategoriKontenRepo->find($kategoriKonten->id);
        $this->assertModelData($fakeKategoriKonten, $dbKategoriKonten->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteKategoriKonten()
    {
        $kategoriKonten = $this->makeKategoriKonten();
        $resp = $this->kategoriKontenRepo->delete($kategoriKonten->id);
        $this->assertTrue($resp);
        $this->assertNull(KategoriKonten::find($kategoriKonten->id), 'KategoriKonten should not exist in DB');
    }
}
