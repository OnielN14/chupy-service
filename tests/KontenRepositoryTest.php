<?php

use App\Models\Konten;
use App\Repositories\KontenRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class KontenRepositoryTest extends TestCase
{
    use MakeKontenTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var KontenRepository
     */
    protected $kontenRepo;

    public function setUp()
    {
        parent::setUp();
        $this->kontenRepo = App::make(KontenRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateKonten()
    {
        $konten = $this->fakeKontenData();
        $createdKonten = $this->kontenRepo->create($konten);
        $createdKonten = $createdKonten->toArray();
        $this->assertArrayHasKey('id', $createdKonten);
        $this->assertNotNull($createdKonten['id'], 'Created Konten must have id specified');
        $this->assertNotNull(Konten::find($createdKonten['id']), 'Konten with given id must be in DB');
        $this->assertModelData($konten, $createdKonten);
    }

    /**
     * @test read
     */
    public function testReadKonten()
    {
        $konten = $this->makeKonten();
        $dbKonten = $this->kontenRepo->find($konten->id);
        $dbKonten = $dbKonten->toArray();
        $this->assertModelData($konten->toArray(), $dbKonten);
    }

    /**
     * @test update
     */
    public function testUpdateKonten()
    {
        $konten = $this->makeKonten();
        $fakeKonten = $this->fakeKontenData();
        $updatedKonten = $this->kontenRepo->update($fakeKonten, $konten->id);
        $this->assertModelData($fakeKonten, $updatedKonten->toArray());
        $dbKonten = $this->kontenRepo->find($konten->id);
        $this->assertModelData($fakeKonten, $dbKonten->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteKonten()
    {
        $konten = $this->makeKonten();
        $resp = $this->kontenRepo->delete($konten->id);
        $this->assertTrue($resp);
        $this->assertNull(Konten::find($konten->id), 'Konten should not exist in DB');
    }
}
