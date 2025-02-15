<?php

declare(strict_types=1);

namespace Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

final class QuizTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Route::middleware('auth:sanctum')->group(function (): void {
            require base_path('routes/web.php');
        });
    }

    public function test_if_guest_can_create_quiz(): void
    {
        $this->postJson(route('quiz:store'), [
            'title' => 'Test Quiz',

        ])->assertStatus(401);
    }

    public function test_if_guest_can_see_list_of_quizzes(): void
    {
        $this->getJson(route('quiz:index'))
            ->assertStatus(200)
            ->assertJsonStructure(['data']);
    }

    public function test_if_guest_can_delete_quiz(): void
    {
        $this->deleteJson(route('quiz:delete', ['quiz' => 1]))
            ->assertStatus(401);
    }

    public function test_if_guest_can_update_quiz(): void
    {
        $this->putJson(route('quiz:update', ['quiz' => 1]))
            ->assertStatus(401);
    }

    public function test_if_admin_user_can_create_quiz(): void
    {
        $user = User::factory()->create([
            'is_admin' => true,
        ]);

        $data = [
            'title' => 'Test Title',
            'questions' => [
                [
                    'content' => 'first question',
                    'answers' => [
                        ['content' => 'Nice answer', 'is_correct' => false],
                        ['content' => 'Another answer', 'is_correct' => true],
                        ['content' => 'Yet another answer', 'is_correct' => false],
                        ['content' => 'Fourth one', 'is_correct' => false],
                    ],
                ],
                [
                    'content' => 'second question',
                    'answers' => [
                        ['content' => 'Nice answer', 'is_correct' => false],
                        ['content' => 'Another answer', 'is_correct' => true],
                        ['content' => 'Yet another answer', 'is_correct' => false],
                        ['content' => 'Fourth one', 'is_correct' => false],
                    ],
                ],
            ],
        ];

        $this->actingAs($user)->postJson(route('quiz:store'), $data)->assertStatus(201);
        $this->assertDatabaseHas('quizzes', ['title' => 'Test Title']);
        $this->assertDatabaseHas('questions', ['content' => 'second question']);
        $this->assertDatabaseHas('answers', ['content' => 'Nice answer', 'is_correct' => false]);
    }
}
