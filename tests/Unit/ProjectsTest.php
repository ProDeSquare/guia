<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Student;

class ProjectsTest extends TestCase
{
    public function test_students_can_view_project()
    {
        $this->actingAs(Student::first(), 'student');

        $response = $this->get('/group/view/project/1');

        $response->assertStatus(200);
    }

    public function test_students_can_update_project()
    {
        $this->actingAs(Student::first(), 'student');

        $response = $this->patch('/group/update/project/1', [
            'title' => 'The best project',
            'description' => 'lorem ipsum dolor',
            'technologies' => 'AI, ML, Docker',
            'github_repo' => 'https://github.com/prodesquare/final-year-project',
            'link' => 'https://fyp.prodesquare.com',
        ]);

        $response->assertRedirect('/group/view/project/1');
    }
}
