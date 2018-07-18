<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class KontenApiTest extends TestCase
{
    use MakeKontenTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateKonten()
    {
        $konten = $this->fakeKontenData();
        $this->json('POST', '/api/v1/kontens', $konten);

        $this->assertApiResponse($konten);
    }

    /**
     * @test
     */
    public function testReadKonten()
    {
        $konten = $this->makeKonten();
        $this->json('GET', '/api/v1/kontens/'.$konten->id);

        $this->assertApiResponse($konten->toArray());
    }

    /**
     * @test
     */
    public function testUpdateKonten()
    {
        $konten = $this->makeKonten();
        $editedKonten = $this->fakeKontenData();

        $this->json('PUT', '/api/v1/kontens/'.$konten->id, $editedKonten);

        $this->assertApiResponse($editedKonten);
    }

    /**
     * @test
     */
    public function testDeleteKonten()
    {
        $konten = $this->makeKonten();
        $this->json('DELETE', '/api/v1/kontens/'.$konten->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/kontens/'.$konten->id);

        $this->assertResponseStatus(404);
    }
}
