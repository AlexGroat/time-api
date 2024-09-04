<?php

namespace Tests\Feature\Http\Controllers\Api;

use Tests\TestCase;

class CompleteWeekIntervalControllerTest extends TestCase
{
    public function testBasic()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
