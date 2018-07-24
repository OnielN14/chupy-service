<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TagKontenApiTest extends TestCase
{
    use MakeTagKontenTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateTagKonten()
    {
        $tagKonten = $this->fakeTagKontenData();
        $this->json('POST', '/api/v1/tagKontens', $tagKonten);

        $this->assertApiResponse($tagKonten);
    }

    /**
     * @test
     */
    public function testReadTagKonten()
    {
        $tagKonten = $this->makeTagKonten();
        $this->json('GET', '/api/v1/tagKontens/'.$tagKonten->id);

        $this->assertApiResponse($tagKonten->toArray());
    }

    /**
     * @test
     */
    public function testUpdateTagKonten()
    {
        $tagKonten = $this->makeTagKonten();
        $editedTagKonten = $this->fakeTagKontenData();

        $this->json('PUT', '/api/v1/tagKontens/'.$tagKonten->id, $editedTagKonten);

        $this->assertApiResponse($editedTagKonten);
    }

    /**
     * @test
     */
    public function testDeleteTagKonten()
    {
        $tagKonten = $this->makeTagKonten();
        $this->json('DELETE', '/api/v1/tagKontens/'.$tagKonten->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/tagKontens/'.$tagKonten->id);

        $this->assertResponseStatus(404);
    }
}
