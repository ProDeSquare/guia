<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminTest extends TestCase
{
    public function test_admin_login_page_is_accessible()
    {
        Admin::create([
            'name' => 'Hamza Mughal',
            'email' => 'hamza@prodesquare.com',
            'password' => Hash::make('hamza123'),
        ]);

        $response = $this->get('/admin/login');

        $response->assertStatus(200);
    }

    public function test_admin_can_perform_login()
    {
        $response = $this->post('/admin/login', [
            'email' => 'hamza@prodesquare.com',
            'password' => 'hamza123',
        ]);

        $response->assertRedirect('/admin');
    }

    public function test_admin_can_update_their_password()
    {
        $this->actingAs(Admin::first(), 'admin');

        $response = $this->post('/auth/auth/update/password', [
            'current_password' => 'hamza123',
            'password' => 'hamza1234',
            'password_confirmation' => 'hamza1234',
        ]);

        $response->assertRedirect('/admin/account/settings');
    }

    public function test_admin_can_view_add_moderators_page()
    {
        $this->actingAs(Admin::first(), 'admin');

        $response = $this->get('/admin/add/moderator');

        $response->assertStatus(200);
    }

    public function test_admin_can_add_moderator()
    {
        $this->actingAs(Admin::first(), 'admin');

        $response = $this->post('/admin/add/moderator', [
            'name' => 'Zeeshan Ghumman',
            'email' => 'zeeshan@gmail.com',
            'password' => 'hamza123',
        ]);

        $response->assertRedirect('/admin/add/moderator');
    }

    public function test_admin_can_view_add_faqs_page()
    {
        $this->actingAs(Admin::first(), 'admin');

        $response = $this->get('/frequently-asked-questions/add');

        $response->assertStatus(200);
    }

    public function test_admin_can_answer_faq()
    {
        $this->actingAs(Admin::first(), 'admin');

        $response = $this->post('/frequently-asked-questions/add', [
            'question' => 'Test Question',
            'answer' => 'Test Answer',
        ]);

        $response->assertRedirect('/frequently-asked-questions/add');
    }

    public function test_admin_can_logout()
    {
        $this->actingAs(Admin::first(), 'admin');

        $response = $this->post('/auth/auth/logout');

        $response->assertRedirect('/');
    }

    public function test_admin_can_view_all_moderators()
    {
        $this->actingAs(Admin::first(), 'admin');

        $response = $this->get('/mod/view/all');

        $response->assertStatus(200);
    }

    public function test_admin_can_view_all_teachers()
    {
        $this->actingAs(Admin::first(), 'admin');

        $response = $this->get('/teacher/view/all');

        $response->assertStatus(200);
    }

    public function test_admin_can_view_all_students()
    {
        $this->actingAs(Admin::first(), 'admin');

        $response = $this->get('/student/view/all');

        $response->assertStatus(200);
    }

    public function test_admin_can_view_admin_profile_page()
    {
        $this->actingAs(Admin::first(), 'admin');

        $response = $this->get(config('database.default') === 'mysql' ? '/admin/view/2' : '/admin/view/1');

        $response->assertStatus(200);
    }

    public function test_admin_can_view_moderator_profile_page()
    {
        $this->actingAs(Admin::first(), 'admin');

        $response = $this->get('/mod/view/1');

        $response->assertStatus(200);
    }
}
