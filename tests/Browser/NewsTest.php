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

    public function testNewsCreateExample()
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

    public function testNewsCreateErrorExample()
    {
        //форма содержит ошибку
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/news/create')
                ->type('title', '')
                ->type('author', 'admin')
                ->select('status', 'draft')
                ->type('description', 'SomeText')
                ->select('category_id', 1)
                ->press('Создать')
                ->assertPathIs('/admin/news/create');
        });
    }

    public function testNewsEditExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/news/1/edit')
                ->type('title', 'Some Title')
                ->type('author', 'admin')
                ->select('status', 'draft')
                ->type('description', 'SomeText')
                ->select('category_id', 1)
                ->press('Сохранить')
                ->assertPathIs('/admin/news');
        });
    }

    public function testNewsEditErrorExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/news/1/edit')
                ->type('title', '111')
                ->type('author', 'admin')
                ->select('status', 'draft')
                ->type('description', 'SomeText')
                ->select('category_id', 1)
                ->press('Сохранить')
                ->assertPathIs('/admin/news/1/edit');
        });
    }
}
