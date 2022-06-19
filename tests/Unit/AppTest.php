<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AppTest extends TestCase
{
    use RefreshDatabase;

    public function test_app_setup_page()
    {
        $response = $this->get('/app/setup');

        $response->assertStatus(200);
    }

    public function test_admin_account_can_be_created()
    {
        $response = $this->post('/app/setup', [
            'name' => 'Hamza Mughal',
            'email' => 'hamza@prodesquare.com',
            'password' => 'hamza123',
        ]);

        $response->assertRedirect('/admin/login');
    }
}
