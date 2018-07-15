<?php

use App\Models\Map;
use App\Repositories\MapRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MapRepositoryTest extends TestCase
{
    use MakeMapTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var MapRepository
     */
    protected $mapRepo;

    public function setUp()
    {
        parent::setUp();
        $this->mapRepo = App::make(MapRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateMap()
    {
        $map = $this->fakeMapData();
        $createdMap = $this->mapRepo->create($map);
        $createdMap = $createdMap->toArray();
        $this->assertArrayHasKey('id', $createdMap);
        $this->assertNotNull($createdMap['id'], 'Created Map must have id specified');
        $this->assertNotNull(Map::find($createdMap['id']), 'Map with given id must be in DB');
        $this->assertModelData($map, $createdMap);
    }

    /**
     * @test read
     */
    public function testReadMap()
    {
        $map = $this->makeMap();
        $dbMap = $this->mapRepo->find($map->id);
        $dbMap = $dbMap->toArray();
        $this->assertModelData($map->toArray(), $dbMap);
    }

    /**
     * @test update
     */
    public function testUpdateMap()
    {
        $map = $this->makeMap();
        $fakeMap = $this->fakeMapData();
        $updatedMap = $this->mapRepo->update($fakeMap, $map->id);
        $this->assertModelData($fakeMap, $updatedMap->toArray());
        $dbMap = $this->mapRepo->find($map->id);
        $this->assertModelData($fakeMap, $dbMap->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteMap()
    {
        $map = $this->makeMap();
        $resp = $this->mapRepo->delete($map->id);
        $this->assertTrue($resp);
        $this->assertNull(Map::find($map->id), 'Map should not exist in DB');
    }
}
