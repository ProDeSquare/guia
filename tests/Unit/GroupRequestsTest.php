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
}
