<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class myFirstTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_red(){

        $html = file_get_contents('/jugar/31313');

        $this->assertTrue(substr_count($html,'bg-red-500') == 3);
    }

    public function test_blue(){

        $html = file_get_contents('https://cuatroenlinea.ddev.site/jugar/1212');

        $this->assertTrue(substr_count($html,'bg-sky-500') == 2);
    }

    public function test_table(){

        $html = file_get_contents('https://cuatroenlinea.ddev.site/jugar/1');

        $this->assertTrue(substr_count($html,'bg-gray-200') == 41);
    }
}
