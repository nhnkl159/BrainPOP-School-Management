<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

use App\Models\Student;
use App\Models\Teacher;

class authTest extends TestCase
{
    /**
     * A basic authentication test for student.
     *
     * @return void
     */
    public function test_student_login_successfully()
    {
        Student::factory()->create([
            'username' => 'test_student',
            'password' => Hash::make('123123')
        ]);

        $response = $this->post('/auth/student', ['username' => 'test_student', 'password' => '123123']);

        $response->assertStatus(200);
    }

    /**
     * A basic authentication test for teacher.
     *
     * @return void
     */
    public function test_teacher_login_successfully()
    {
        Teacher::factory()->create([
            'username' => 'test_teacher',
            'password' => Hash::make('123123')
        ]);

        $response = $this->post('/auth/teacher', ['username' => 'test_teacher', 'password' => '123123']);

        $response->assertStatus(200);
    }

    /**
     * A basic check for unauthorized user for students route.
     *
     * @return void
     */
    public function test_unauthorized_user_cannot_access_students()
    {
        $response = $this->get('/api/students');

        $response->assertStatus(401);
    }
}
