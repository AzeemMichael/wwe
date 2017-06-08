<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterUserTest extends DuskTestCase
{
    public function testRegisterUser()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->type('name', str_random(10))
                ->type('email', str_random(7).'@example.com')
                ->type('password', 'secret')
                ->type('password_confirmation', 'secret')
                ->press('Register')
                ->assertPathIs('/');
        });
    }
}
