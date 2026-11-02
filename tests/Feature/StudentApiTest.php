<?php

namespace Tests\Feature;

use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class StudentApiTest extends TestCase
{
     use RefreshDatabase;

    /**
     * Test that an authenticated user can list students.
     */
    public function test_authenticated_user_can_list_students(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user, [
            'students:read',
        ]);

        Student::factory()->count(2)->create();

        $response = $this->getJson('/api/students');

        $response->assertOk();
        $response->assertJsonStructure([
            'data',
        ]);
    }

    /**
     * Test that an unauthenticated user cannot list students.
     */
    public function test_unauthenticated_user_cannot_list_students(): void
    {
        $response = $this->getJson('/api/students');

        $response->assertUnauthorized();
    }

    /**
     * Test that an authenticated user can create a student.
     */
    public function test_authenticated_user_can_create_student(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user, [
            'students:create',
        ]);

        Storage::fake('public');

        $response = $this->post('/api/students', [
            'name' => 'Test Student',
            'file' => UploadedFile::fake()->create(
                'document.pdf',
                100,
                'application/pdf'
            ),
        ]);

        $response->assertCreated();

        $this->assertDatabaseHas('student', [
            'name' => 'Test Student',
        ]);
    }

    /**
     * Test that an authenticated user can update a student.
     */
    public function test_authenticated_user_can_update_student(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user, [
            'students:update',
        ]);

        $student = Student::factory()->create([
            'name' => 'Old Name',
        ]);

        $response = $this->putJson(
            "/api/students/{$student->id}",
            [
                'name' => 'Updated Name',
            ]
        );

        $response->assertOk();

        $this->assertDatabaseHas('student', [
            'id' => $student->id,
            'name' => 'Updated Name',
        ]);
    }

    /**
     * Test that an admin can delete a student.
     */
    public function test_admin_can_delete_student(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        Sanctum::actingAs($admin, [
            'students:delete',
        ]);

        $student = Student::factory()->create();

        $response = $this->deleteJson(
            "/api/students/{$student->id}"
        );

        $response->assertOk();

        $this->assertDatabaseMissing('student', [
            'id' => $student->id,
        ]);
    }

    /**
     * Test that a regular user cannot delete a student.
     */
    public function test_regular_user_cannot_delete_student(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
        ]);

        Sanctum::actingAs($user, [
            'students:delete',
        ]);

        $student = Student::factory()->create();

        $response = $this->deleteJson(
            "/api/students/{$student->id}"
        );

        $response->assertForbidden();

        $this->assertDatabaseHas('student', [
            'id' => $student->id,
        ]);
    }


}
