<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\{Admin, Mod, Teacher, Student};

class SearchTest extends TestCase
{
    public function test_admin_can_perform_search()
    {
        $this->actingAs(Admin::first(), 'admin');

        $response = $this->get('/search?q=lorem');

        $response->assertStatus(200);
    }

    public function test_moderator_can_perform_search()
    {
        $this->actingAs(Mod::first(), 'mod');

        $response = $this->get('/search?q=lorem');

        $response->assertStatus(200);
    }

    public function test_teacher_can_perform_search()
    {
        $this->actingAs(Teacher::first(), 'teacher');

        $response = $this->get('/search?q=lorem');

        $response->assertStatus(200);
    }

    public function test_student_can_perform_search()
    {
        $this->actingAs(Student::first(), 'student');

        $response = $this->get('/search?q=lorem');

        $response->assertStatus(200);
    }
}
