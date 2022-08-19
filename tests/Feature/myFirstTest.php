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

        $html = $this->get('https://cuatroenlinea.ddev.site/jugar/31313');

        $red = preg_match_all('/<div class="bg-red/', $html->getContent());

        $this->assertTrue($red === 3);
    }

    public function test_blue(){

        $html = $this->get('https://cuatroenlinea.ddev.site/jugar/1212');

        $blue = preg_match_all('/<div class="bg-sky/', $html->getContent());

        $this->assertTrue($blue === 2);
    }

    public function test_table(){

        $html = $this->get('https://cuatroenlinea.ddev.site/jugar/1');
    
        $blue = preg_match_all('/<div class="bg-gray/', $html->getContent());

        $this->assertTrue($blue === 41);
    }

    public function test_next_movement(){

        $html = $this->get('https://cuatroenlinea.ddev.site/jugar/1');

        $spinners = preg_match_all('/hover:animate-spin/', $html->getContent());

        $this->assertTrue($spinners === 7);
    }

    public function test_i_am_not_ready_for_this(){

        $page = $this->get('https://cuatroenlinea.ddev.site/jugar/1111112222223333334444445555556666667777771');

        $page->assertStatus(200);
    }
}