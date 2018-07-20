<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class KategoriKontenApiTest extends TestCase
{
    use MakeKategoriKontenTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateKategoriKonten()
    {
        $kategoriKonten = $this->fakeKategoriKontenData();
        $this->json('POST', '/api/v1/kategoriKontens', $kategoriKonten);

        $this->assertApiResponse($kategoriKonten);
    }

    /**
     * @test
     */
    public function testReadKategoriKonten()
    {
        $kategoriKonten = $this->makeKategoriKonten();
        $this->json('GET', '/api/v1/kategoriKontens/'.$kategoriKonten->id);

        $this->assertApiResponse($kategoriKonten->toArray());
    }

    /**
     * @test
     */
    public function testUpdateKategoriKonten()
    {
        $kategoriKonten = $this->makeKategoriKonten();
        $editedKategoriKonten = $this->fakeKategoriKontenData();

        $this->json('PUT', '/api/v1/kategoriKontens/'.$kategoriKonten->id, $editedKategoriKonten);

        $this->assertApiResponse($editedKategoriKonten);
    }

    /**
     * @test
     */
    public function testDeleteKategoriKonten()
    {
        $kategoriKonten = $this->makeKategoriKonten();
        $this->json('DELETE', '/api/v1/kategoriKontens/'.$kategoriKonten->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/kategoriKontens/'.$kategoriKonten->id);

        $this->assertResponseStatus(404);
    }
}
