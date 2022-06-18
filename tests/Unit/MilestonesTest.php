<?php

namespace Tests\Unit;

use App\Models\{Admin, Mod, Teacher, Student};
use Tests\TestCase;

class MilestonesTest extends TestCase
{
    public function test_students_can_view_create_milestones_page()
    {
        $this->actingAs(Student::first(), 'student');

        $response = $this->get('/group/view/project/1/milestones/add');

        $response->assertStatus(200);
    }

    public function test_students_can_create_milestones()
    {
        $this->actingAs(Student::first(), 'student');

        $response = $this->post('/group/view/project/1/milestones/add', [
            'title' => 'the very first milestone',
            'description' => 'lorem ipsum dolor sit amet.',
            'github_issue_link' => 'https://github.com/prodesquare/final-year-project/issues/1',
        ]);

        $response->assertRedirect('/group/view/project/1/milestones/view/1');
    }

    public function test_admin_can_view_milestones_page()
    {
        $this->actingAs(Admin::first(), 'admin');

        $response = $this->get('/group/view/project/1/milestones/view/1');

        $response->assertStatus(200);
    }

    public function test_moderator_can_view_milestones_page()
    {
        $this->actingAs(Mod::first(), 'mod');

        $response = $this->get('/group/view/project/1/milestones/view/1');

        $response->assertStatus(200);
    }

    public function test_teacher_can_view_milestones_page()
    {
        $this->actingAs(Teacher::first(), 'teacher');

        $response = $this->get('/group/view/project/1/milestones/view/1');

        $response->assertStatus(200);
    }

    public function test_student_can_view_milestones_page()
    {
        $this->actingAs(Student::first(), 'student');

        $response = $this->get('/group/view/project/1/milestones/view/1');

        $response->assertStatus(200);
    }
}
