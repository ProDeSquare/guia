<?php

namespace Tests\Unit;

use Tests\Testcase;
use App\Models\{Admin, Mod, Teacher, Student};

class FileUploadTest extends TestCase
{
	public function test_admin_can_view_file_uploads_page()
	{
			$this->actingAs(Admin::first(), 'admin');

			$response = $this->get('/file-uploads');

			$response->assertStatus(200);
	}

	public function test_moderator_can_view_file_uploads_page()
    {
        $this->actingAs(Mod::first(), 'mod');

        $response = $this->get('/file-uploads');

        $response->assertStatus(200);
    }

    public function test_teacher_can_view_file_uploads_page()
    {
        $this->actingAs(Teacher::first(), 'teacher');

        $response = $this->get('/file-uploads');

        $response->assertStatus(200);
    }

    public function test_student_can_view_file_uploads_page()
    {
        $this->actingAs(Student::first(), 'student');

        $response = $this->get('/file-uploads');

        $response->assertStatus(200);
    }
}