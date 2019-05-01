<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecipeTest extends TestCase
{
    /**
     * A basic test to verify the homepage is accessible.
     *
     * @return void
     */
    public function testHomepage()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testContactPage()
    {
        $response = $this->get('/kontakt');
        $response->assertStatus(200);
    }

    public function testSignupPage()
    {
        $response = $this->get('/registrieren');
        $response->assertStatus(200);
    }
}
