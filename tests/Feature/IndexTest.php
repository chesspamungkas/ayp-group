<?php

namespace Tests\Feature;

use Tests\TestCase;

class IndexTest extends TestCase
{
    public function testHealthCheck()
    {
        $this->json('GET', '/ayp-api/v1/')->seeJsonEquals([
            "data" => [
                "dbConnection" => true,
            ]
        ]);
    }
}
