<?php

namespace Tests\Feature\Http\Controllers\Api;

use Tests\TestCase;

class DayIntervalControllerTest extends TestCase
{
    public function testBasic()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
