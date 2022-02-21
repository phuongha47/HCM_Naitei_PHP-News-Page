<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CategoryAddTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {   //test See
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/category/create')
                ->maximize()
                ->assertSee('Add Category')
                ->assertSee('Fill in category\'s informations:');
            });
        //test Action
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/category/create')
                ->type('name', 'Category');
            });
    }
}
