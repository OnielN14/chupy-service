<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PenggunaApiTest extends TestCase
{
    use MakePenggunaTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePengguna()
    {
        $pengguna = $this->fakePenggunaData();
        $this->json('POST', '/api/v1/penggunas', $pengguna);

        $this->assertApiResponse($pengguna);
    }

    /**
     * @test
     */
    public function testReadPengguna()
    {
        $pengguna = $this->makePengguna();
        $this->json('GET', '/api/v1/penggunas/'.$pengguna->id);

        $this->assertApiResponse($pengguna->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePengguna()
    {
        $pengguna = $this->makePengguna();
        $editedPengguna = $this->fakePenggunaData();

        $this->json('PUT', '/api/v1/penggunas/'.$pengguna->id, $editedPengguna);

        $this->assertApiResponse($editedPengguna);
    }

    /**
     * @test
     */
    public function testDeletePengguna()
    {
        $pengguna = $this->makePengguna();
        $this->json('DELETE', '/api/v1/penggunas/'.$pengguna->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/penggunas/'.$pengguna->id);

        $this->assertResponseStatus(404);
    }
}
