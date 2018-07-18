<?php

use App\Models\Produk;
use App\Repositories\ProdukRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProdukRepositoryTest extends TestCase
{
    use MakeProdukTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ProdukRepository
     */
    protected $produkRepo;

    public function setUp()
    {
        parent::setUp();
        $this->produkRepo = App::make(ProdukRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateProduk()
    {
        $produk = $this->fakeProdukData();
        $createdProduk = $this->produkRepo->create($produk);
        $createdProduk = $createdProduk->toArray();
        $this->assertArrayHasKey('id', $createdProduk);
        $this->assertNotNull($createdProduk['id'], 'Created Produk must have id specified');
        $this->assertNotNull(Produk::find($createdProduk['id']), 'Produk with given id must be in DB');
        $this->assertModelData($produk, $createdProduk);
    }

    /**
     * @test read
     */
    public function testReadProduk()
    {
        $produk = $this->makeProduk();
        $dbProduk = $this->produkRepo->find($produk->id);
        $dbProduk = $dbProduk->toArray();
        $this->assertModelData($produk->toArray(), $dbProduk);
    }

    /**
     * @test update
     */
    public function testUpdateProduk()
    {
        $produk = $this->makeProduk();
        $fakeProduk = $this->fakeProdukData();
        $updatedProduk = $this->produkRepo->update($fakeProduk, $produk->id);
        $this->assertModelData($fakeProduk, $updatedProduk->toArray());
        $dbProduk = $this->produkRepo->find($produk->id);
        $this->assertModelData($fakeProduk, $dbProduk->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteProduk()
    {
        $produk = $this->makeProduk();
        $resp = $this->produkRepo->delete($produk->id);
        $this->assertTrue($resp);
        $this->assertNull(Produk::find($produk->id), 'Produk should not exist in DB');
    }
}
