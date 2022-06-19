<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\{Student, Teacher};

class SupervisionTest extends TestCase
{
    public function test_student_can_send_supervision_request()
    {
        $this->actingAs(Student::first(), 'student');

        $response = $this->post('/supervisor/request/1');

        $response->assertRedirect('/teacher/view/1');
    }

    public function test_teacher_can_view_requests()
    {
        $this->actingAs(Teacher::first(), 'teacher');

        $response = $this->get('/teacher/supervision/requests');

        $response->assertStatus(200);
    }

    public function test_teacher_can_accept_supervision_request()
    {
        $this->actingAs(Teacher::first(), 'teacher');

        $response = $this->post('supervisor/request/accept/1/1');

        $response->assertRedirect();
    }
}
