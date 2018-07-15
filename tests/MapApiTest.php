<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MapApiTest extends TestCase
{
    use MakeMapTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateMap()
    {
        $map = $this->fakeMapData();
        $this->json('POST', '/api/v1/maps', $map);

        $this->assertApiResponse($map);
    }

    /**
     * @test
     */
    public function testReadMap()
    {
        $map = $this->makeMap();
        $this->json('GET', '/api/v1/maps/'.$map->id);

        $this->assertApiResponse($map->toArray());
    }

    /**
     * @test
     */
    public function testUpdateMap()
    {
        $map = $this->makeMap();
        $editedMap = $this->fakeMapData();

        $this->json('PUT', '/api/v1/maps/'.$map->id, $editedMap);

        $this->assertApiResponse($editedMap);
    }

    /**
     * @test
     */
    public function testDeleteMap()
    {
        $map = $this->makeMap();
        $this->json('DELETE', '/api/v1/maps/'.$map->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/maps/'.$map->id);

        $this->assertResponseStatus(404);
    }
}
