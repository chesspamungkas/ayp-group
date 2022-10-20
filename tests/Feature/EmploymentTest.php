<?php

namespace Tests\Feature;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

use Tests\TestCase;

class EmploymentTest extends TestCase
{   
    // use DatabaseMigrations;

    /**
     * /ayp-api/v1/employment [POST]
    */
    public function testAddNewEmployment()
    {
        $response = $this->call('POST', '/ayp-api/v1/employment', 
            [
                'workerEmail' => 'john@ayp-group.com',
                'companyName' => 'Alpha Corp.',
                'jobTitle' => 'Software Engineer',
                'startDate' => '2022-01-28'
            ]);

        $this->assertEquals(200, $response->status());
        $response->assertJsonStructure(['data']);
    }

    /**
     * /ayp-api/v1/employment [PATCH]
    */
    public function testUpdateEmployment()
    {
        $response = $this->call('PATCH', '/ayp-api/v1/employment', 
            [
                'workerEmploymentId' => 3,
                'endDate' => '2022-02-28'
            ]);

            dd($response->getContent());
        // $this->assertEquals(200, $response->status());
        // $response->assertJsonStructure(['data']);
    }
}
