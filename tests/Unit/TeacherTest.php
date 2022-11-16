<?php

namespace Tests\Unit;

use App\Models\Teacher;
use Tests\TestCase;

class TeacherTest extends TestCase
{
    public function test_teacher_login_page_is_visible()
    {
        $response = $this->get('/teacher/login');

        $response->assertStatus(200);
    }

    public function test_teacher_can_perform_login()
    {
        $response = $this->post('/teacher/login', [
            'email' => 'zain@gmail.com',
            'password' => 'hamza123',
        ]);

        $response->assertRedirect('/teacher');
    }

    public function test_teacher_can_logout()
    {
        $this->actingAs(Teacher::first(), 'teacher');

        $response = $this->post('/auth/auth/logout');

        $response->assertRedirect('/');
    }

    public function test_teacher_can_view_their_profile()
    {
        $this->actingAs(Teacher::first(), 'teacher');

        $response = $this->get('/teacher/view/1');

        $response->assertStatus(200);
    }

    public function test_teacher_should_not_be_able_to_view_admin_profile()
    {
        $this->actingAs(Teacher::first(), 'teacher');

        $response = $this->get('/admin/view/2');

        $response->assertStatus(403);
    }

    public function test_teacher_should_not_be_able_to_view_moderator_profile()
    {
        $this->actingAs(Teacher::first(), 'teacher');

        $response = $this->get('/mod/view/1');

        $response->assertStatus(403);
    }

    public function test_teacher_can_view_students_profile()
    {
        $this->actingAs(Teacher::first(), 'teacher');

        $response = $this->get('/student/view/1');

        $response->assertStatus(200);
    }

    public function test_teacher_can_update_their_password()
    {
        $this->actingAs(Teacher::first(), 'teacher');

        $response = $this->post('/auth/auth/update/password', [
            'current_password' => 'hamza123',
            'password' => 'hamza1234',
            'password_confirmation' => 'hamza1234',
        ]);

        $response->assertRedirect('/teacher/account/settings');
    }

    public function test_teacher_can_update_their_profile()
    {
        $this->actingAs(Teacher::first(), 'teacher');

        $response = $this->post('/teacher/profile/update', [
            'bio' => 'I\'m the best teacher',
            'requirements' => 'GitHub Copilot',
            'whatsapp' => 'wa.me/03036310300',
        ]);

        $response->assertRedirect('/teacher/account/settings');
    }
}
