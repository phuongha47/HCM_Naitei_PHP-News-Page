<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegisterTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/user/create')
                    // ->assertSee('Register')
                    // Tìm element bằng thuộc tính name
                    ->assertPresent('input[name="name"]')
                    // ->assertPresent('input[name="email"]')
                    // Tìm element bằng thuộc tính id
                    // ->assertPresent('#password')
                    // ->assertPresent('#password-confirm')
                    // Tìm element bằng thuộc tính class
                    ->assertPresent('.btn-primary');
        });
    }
}
