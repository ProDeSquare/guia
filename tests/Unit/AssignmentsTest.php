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

    public function test_student_can_make_submission()
    {
        $this->actingAs(Student::first(), 'student');

        $response = $this->post('/group/view/project/1/milestones/1/assignments/1/submission/add', [
            'submission' => 'this is a test submission made to prodesquare',
            'github_commit_url' => 'https://github.com/ProDeSquare/final-year-project/commit/079d736d8d974a91e6bd8d10f1662c4967dad3f6',
        ]);

        $response->assertRedirect('/group/view/project/1/milestones/1/assignments/view/1#submission-1');
    }

    public function test_teacher_can_reply_to_submission()
    {
        $this->actingAs(Teacher::first(), 'teacher');

        $response = $this->post('/group/view/project/1/milestones/1/assignments/1/submission/add', [
            'submission' => 'this is a test reply to submission made to prodesquare',
            'github_commit_url' => 'https://github.com/ProDeSquare/final-year-project/commit/079d736d8d974a91e6bd8d10f1662c4967dad3f6',
        ]);

        $response->assertRedirect('/group/view/project/1/milestones/1/assignments/view/1#submission-2');
    }

    public function test_teacher_can_mark_assignment_as_done()
    {
        $this->actingAs(Teacher::first(), 'teacher');

        $response = $this->put('/group/view/project/1/milestones/1/assignments/1/mark-as-completed');

        $response->assertRedirect('/group/view/project/1/milestones/1/assignments/view/1');
    }
}
