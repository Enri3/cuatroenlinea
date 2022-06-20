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

    public function test_the_web_it_is_online()
    {
        $page = $this->get('https://cuatroenlinea.ddev.site/jugar/1');

        $page->assertStatus(200);
    }

    public function test_red(){

        $html = file_get_contents('https://cuatroenlinea.ddev.site/jugar/31313');

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

    public function test_next_movement(){

        $html = file_get_contents('https://cuatroenlinea.ddev.site/jugar/1');

        $this->assertTrue(substr_count($html,'hover:animate-spin') == 7);
    }

    public function test_i_am_not_ready_for_this(){

        $page = $this->get('https://cuatroenlinea.ddev.site/jugar/1111112222223333334444445555556666667777771');

        $page->assertStatus(200);
    }
}