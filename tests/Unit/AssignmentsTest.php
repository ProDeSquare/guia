<?php

namespace Tests\Unit;

use App\Models\Student;
use Tests\TestCase;
use App\Models\Teacher;

class AssignmentsTest extends TestCase
{
    public function test_teacher_can_view_create_assignment_page()
    {
        $this->actingAs(Teacher::first(), 'teacher');

        $response = $this->get('/group/view/project/1/milestones/1/assignments/create');

        $response->assertStatus(200);
    }

    public function test_teacher_can_create_assignment()
    {
        $this->actingAs(Teacher::first(), 'teacher');

        $response = $this->post('/group/view/project/1/milestones/1/assignments/create', [
            'title' => 'first assignment',
            'description' => 'lorem ipsum dolor sit amet.',
            'student_id' => 1,
        ]);

        $response->assertRedirect('/group/view/project/1/milestones/view/1');
    }

    // teacher can mark assignment as done
    // public function test_student_can_mark_assignment_as_done()
    // {
    //     $this->actingAs(Student::first(), 'student');

    //     $response = $this->put('/group/view/project/1/milestones/1/assignments/1/mark-as-completed', [
    //         'github_commit_link' => 'https://github.com/ProDeSquare/final-year-project/commit/079d736d8d974a91e6bd8d10f1662c4967dad3f6',
    //         'is_completed' => 1,
    //     ]);

    //     $response->assertRedirect('/group/view/project/1/milestones/1/assignments/view/1');
    // }
}
