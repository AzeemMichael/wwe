<?php

namespace Tests\Browser;

use App\Models\Role;
use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoggedinUserTest extends DuskTestCase
{
    protected $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = User::adminUser()->first();

        if ($this->user === null) {
            $this->user = factory(User::class)->create();
            $role = Role::where('name', 'ROLE_ADMIN')->first();

            if ($role === null) {
                $role = Role::create(['name' => 'ROLE_ADMIN']);
            }
            $this->user->role()->associate($role);
        }
    }

    public function testLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', $this->user->email)
                ->type('password', 'secret')
                ->press('Login')
                ->assertPathIs('/');
        });
    }

    public function testUploadVideo()
    {
        $this->actingAs($this->user);
        $title = str_random(20);

        $this->browse(function (Browser $browser) use($title) {
            $browser->visit('/videos/create')
                ->type('#title', $title)
                ->attach('video', __DIR__.'/_files/dotcom_nxt392_tomnight_512x288.mp4')
                ->press('Send');

            $video = Video::where('title', $title)->first();

            $this->assertTrue($video !== null);
            $this->assertTrue(Storage::exists($video->path));
        });
    }
}
