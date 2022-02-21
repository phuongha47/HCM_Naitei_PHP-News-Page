<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UserListTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {   //test See
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/user')
                ->maximize()
                ->assertSee('List of users')
                ->assertSee('Name')
                ->assertSee('Email')
                ->assertSee('Level')
                ->assertSee('Edit')
                ->assertSee('Delete');
            });
        //test Action
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/user')
                ->click('@delete-button')
                ->type('search', 'covid')
                ->press('@search')
                ->assertPathIsNot('/admin/user');
            });
    }
}
