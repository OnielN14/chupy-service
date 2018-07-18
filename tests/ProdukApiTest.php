<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProdukApiTest extends TestCase
{
    use MakeProdukTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateProduk()
    {
        $produk = $this->fakeProdukData();
        $this->json('POST', '/api/v1/produks', $produk);

        $this->assertApiResponse($produk);
    }

    /**
     * @test
     */
    public function testReadProduk()
    {
        $produk = $this->makeProduk();
        $this->json('GET', '/api/v1/produks/'.$produk->id);

        $this->assertApiResponse($produk->toArray());
    }

    /**
     * @test
     */
    public function testUpdateProduk()
    {
        $produk = $this->makeProduk();
        $editedProduk = $this->fakeProdukData();

        $this->json('PUT', '/api/v1/produks/'.$produk->id, $editedProduk);

        $this->assertApiResponse($editedProduk);
    }

    /**
     * @test
     */
    public function testDeleteProduk()
    {
        $produk = $this->makeProduk();
        $this->json('DELETE', '/api/v1/produks/'.$produk->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/produks/'.$produk->id);

        $this->assertResponseStatus(404);
    }
}
