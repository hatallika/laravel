<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class NewsTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Добро пожаловать!');
        });
    }

    public function test1Example()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/news/create')
                    ->type('title', 'Заголовок новости 1')
                    ->type('author', 'admin')
                    ->select('status', 'draft')
                    ->type('description', 'SomeText')
                    ->select('category_id', 1)
                    ->press('Создать')
                    ->assertPathIs('/admin/news');


        });
    }
}
