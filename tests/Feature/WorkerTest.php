<?php

namespace Tests\Feature;

use App\Models\Worker;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

use Tests\TestCase;

class WorkerTest extends TestCase
{
    // use DatabaseTransactions;

    /**
     * /ayp-api/v1/worker [GET]
    */
    public function testShowAllWorker()
    {
        $response = $this->call('GET', '/ayp-api/v1/worker');

        $this->assertEquals(200, $response->status());
        $response->assertJsonStructure(['data']);
    }
    
    /**
     * /ayp-api/v1/worker [POST]
    */
    public function testAddNewWorker(){
        $response = $this->call('POST', '/ayp-api/v1/worker', 
            [
                'firstName' => 'John',
                'lastName' => 'Smith',
                'email' => 'john@ayp-group.com'
            ]);

        $this->assertEquals(200, $response->status());
        $response->assertJsonStructure(['data']); 
    }
}
