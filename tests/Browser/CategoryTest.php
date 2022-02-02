<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CategoryTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/categories')
                    ->assertSee('Список категорий');
        });
    }

    public function testCategoryEdit()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/categories/1/edit')
                ->type('title', 'Some Title')
                ->type('description', 'SomeText')
                ->press('Сохранить')
                ->assertPathIs('/admin/categories');
        });
    }

    public function testCategoryEditError()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/categories/1/edit')
                ->type('title', '111')
                ->type('description', 'SomeText')
                ->press('Сохранить')
                ->assertPathIs('/admin/categories/1/edit');
        });
    }
}
