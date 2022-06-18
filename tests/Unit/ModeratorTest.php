<?php

namespace Tests\Unit;

use App\Models\Mod;
use Tests\TestCase;

class ModeratorTest extends TestCase
{
    public function test_moderator_login_page_is_visible()
    {
        $response = $this->get('/mod/login');

        $response->assertStatus(200);
    }

    public function test_moderator_can_perform_login()
    {
        $response = $this->post('/mod/login', [
            'email' => 'zeeshan@gmail.com',
            'password' => 'hamza123',
        ]);

        $response->assertRedirect('/mod');
    }

    public function test_moderator_can_logout()
    {
        $this->actingAs(Mod::first(), 'mod');

        $response = $this->post('/auth/auth/logout');

        $response->assertRedirect('/');
    }

    public function test_moderator_can_update_their_password()
    {
        $this->actingAs(Mod::first(), 'mod');

        $response = $this->post('/auth/auth/update/password', [
            'current_password' => 'hamza123',
            'password' => 'hamza1234',
            'password_confirmation' => 'hamza1234',
        ]);

        $response->assertRedirect('/mod/account/settings');
    }

    public function test_moderator_can_view_add_teachers_page()
    {
        $this->actingAs(Mod::first(), 'mod');

        $response = $this->get('/mod/add/teacher');

        $response->assertStatus(200);
    }

    public function test_moderator_can_add_teacher()
    {
        $this->actingAs(Mod::first(), 'mod');

        $response = $this->post('/mod/add/teacher', [
            'name' => 'Zain Riaz',
            'email' => 'zain@gmail.com',
            'password' => 'hamza123',
        ]);

        $response->assertRedirect('/mod/add/teacher');
    }

    public function test_moderator_can_view_add_students_page()
    {
        $this->actingAs(Mod::first(), 'mod');

        $response = $this->get('/mod/add/student');

        $response->assertStatus(200);
    }

    public function test_moderator_can_add_student()
    {
        $this->actingAs(Mod::first(), 'mod');

        $response = $this->post('/mod/add/student', [
            'name' => 'Agha Hassan',
            'roll_no' => '10706',
            'username' => 'st1',
            'password' => 'hamza123',
        ]);

        $response->assertRedirect('/mod/add/student');
    }

    public function test_moderator_can_view_all_teachers()
    {
        $this->actingAs(Mod::first(), 'mod');

        $response = $this->get('/teacher/view/all');

        $response->assertStatus(200);
    }

    public function test_moderator_can_view_all_students()
    {
        $this->actingAs(Mod::first(), 'mod');

        $response = $this->get('/student/view/all');

        $response->assertStatus(200);
    }

    public function test_moderator_should_not_view_admin_profile_page()
    {
        $this->actingAs(Mod::first(), 'mod');

        $response = $this->get('/admin/view/2');

        $response->assertStatus(403);
    }

    public function test_moderator_can_view_moderator_profile_page()
    {
        $this->actingAs(Mod::first(), 'mod');

        $response = $this->get('/mod/view/1');

        $response->assertStatus(200);
    }

    public function test_moderator_can_view_teacher_profile_page()
    {
        $this->actingAs(Mod::first(), 'mod');

        $response = $this->get('/teacher/view/1');

        $response->assertStatus(200);
    }

    public function test_moderator_can_view_student_profile_page()
    {
        $this->actingAs(Mod::first(), 'mod');

        $response = $this->get('/student/view/1');

        $response->assertStatus(200);
    }
}
