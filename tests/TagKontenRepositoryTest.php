<?php

use App\Models\TagKonten;
use App\Repositories\TagKontenRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TagKontenRepositoryTest extends TestCase
{
    use MakeTagKontenTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var TagKontenRepository
     */
    protected $tagKontenRepo;

    public function setUp()
    {
        parent::setUp();
        $this->tagKontenRepo = App::make(TagKontenRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateTagKonten()
    {
        $tagKonten = $this->fakeTagKontenData();
        $createdTagKonten = $this->tagKontenRepo->create($tagKonten);
        $createdTagKonten = $createdTagKonten->toArray();
        $this->assertArrayHasKey('id', $createdTagKonten);
        $this->assertNotNull($createdTagKonten['id'], 'Created TagKonten must have id specified');
        $this->assertNotNull(TagKonten::find($createdTagKonten['id']), 'TagKonten with given id must be in DB');
        $this->assertModelData($tagKonten, $createdTagKonten);
    }

    /**
     * @test read
     */
    public function testReadTagKonten()
    {
        $tagKonten = $this->makeTagKonten();
        $dbTagKonten = $this->tagKontenRepo->find($tagKonten->id);
        $dbTagKonten = $dbTagKonten->toArray();
        $this->assertModelData($tagKonten->toArray(), $dbTagKonten);
    }

    /**
     * @test update
     */
    public function testUpdateTagKonten()
    {
        $tagKonten = $this->makeTagKonten();
        $fakeTagKonten = $this->fakeTagKontenData();
        $updatedTagKonten = $this->tagKontenRepo->update($fakeTagKonten, $tagKonten->id);
        $this->assertModelData($fakeTagKonten, $updatedTagKonten->toArray());
        $dbTagKonten = $this->tagKontenRepo->find($tagKonten->id);
        $this->assertModelData($fakeTagKonten, $dbTagKonten->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteTagKonten()
    {
        $tagKonten = $this->makeTagKonten();
        $resp = $this->tagKontenRepo->delete($tagKonten->id);
        $this->assertTrue($resp);
        $this->assertNull(TagKonten::find($tagKonten->id), 'TagKonten should not exist in DB');
    }
}
