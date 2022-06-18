<?php

namespace Tests\Unit;

use App\Models\Student;
use Tests\TestCase;

class StudentTest extends TestCase
{
    public function test_student_login_page_is_visible()
    {
        $response = $this->get('/student/login');

        $response->assertStatus(200);
    }

    public function test_student_can_perform_login()
    {
        $response = $this->post('/student/login', [
            'username' => 'st1',
            'password' => 'hamza123',
        ]);

        $response->assertRedirect('/student');
    }

    public function test_first_student_can_add_email()
    {
        $this->actingAs(Student::first(), 'student');

        $response = $this->post('/student/add/email', [
            'email' => 'agha@gmail.com',
        ]);

        $response->assertRedirect('/student/view/1');
    }

    public function test_second_student_can_add_email()
    {
        $this->actingAs(Student::orderBy('id', 'desc')->first(), 'student');

        $response = $this->post('/student/add/email', [
            'email' => 'saqlain@gmail.com'
        ]);

        $response->assertRedirect('/student/view/2');
    }

    public function test_student_can_logout()
    {
        $this->actingAs(Student::first(), 'student');

        $response = $this->post('/auth/auth/logout');

        $response->assertRedirect('/');
    }

    public function test_student_can_view_their_profile()
    {
        $this->actingAs(Student::first(), 'student');

        $response = $this->get('/student/view/1');

        $response->assertStatus(200);
    }

    public function test_student_should_not_be_able_to_view_admin_profile()
    {
        $this->actingAs(Student::first(), 'student');

        $response = $this->get('/admin/view/2');

        $response->assertStatus(403);
    }

    public function test_student_should_not_be_able_to_view_moderators_profile()
    {
        $this->actingAs(Student::first(), 'student');

        $response = $this->get('/mod/view/1');

        $response->assertStatus(403);
    }

    public function test_student_can_view_teachers_profile()
    {
        $this->actingAs(Student::first(), 'student');

        $response = $this->get('/teacher/view/1');

        $response->assertStatus(200);
    }

    public function test_student_can_update_their_password()
    {
        $this->actingAs(Student::first(), 'student');

        $response = $this->post('/auth/auth/update/password', [
            'current_password' => 'hamza123',
            'password' => 'hamza1234',
            'password_confirmation' => 'hamza1234',
        ]);

        $response->assertRedirect('/student/account/settings');
    }
}
