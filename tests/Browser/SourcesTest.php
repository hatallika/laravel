<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class SourcesTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/sources')
                    ->assertSee('Список источников загрузки');
        });
    }

    public function testSourceEdit()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/sources/1/edit')
                ->type('title', 'Some Title')
                ->type('description', 'SomeText')
                ->radio('active', '1')
                ->press('Сохранить')
                ->assertPathIs('/admin/sources');
        });
    }

    public function testSourceEditError()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/sources/1/edit')
                ->type('title', '111')
                ->type('description', 'SomeText')
                ->radio('active', '1')
                ->press('Сохранить')
                ->assertPathIs('/admin/sources/1/edit');
        });
    }
}
