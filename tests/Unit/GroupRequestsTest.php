<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Student;

class GroupRequestsTest extends TestCase
{
    public function test_student_can_create_group()
    {
        $this->actingAs(Student::first(), 'student');

        $response = $this->post('/student/group/create');

        $response->assertRedirect('/student/view/1');
    }

    public function test_first_student_can_request_second_user()
    {
        $this->actingAs(Student::first(), 'student');

        $response = $this->post('/student/send-group-request/2');

        $response->assertRedirect('/student/view/2');
    }

    public function test_second_student_can_accept_first_students_group_request()
    {
        $this->actingAs(Student::orderBy('id', 'desc')->first(), 'student');

        $response = $this->patch('/student/request/accept/2');

        $response->assertRedirect('/');
    }

    public function test_students_can_add_project()
    {
        $this->actingAs(Student::first(), 'student');

        $response = $this->post('/group/create/project', [
            'title' => 'The best project',
            'description' => 'lorem ipsum',
            'technologies' => 'AI, ML, Docker',
            'github_repo' => 'https://github.com/prodesquare/final-year-project',
            'link' => 'https://fyp.prodesquare.com',
        ]);

        $response->assertRedirect('/group/1/view/projects');
    }
}
