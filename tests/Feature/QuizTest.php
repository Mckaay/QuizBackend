<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Quiz;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class QuizTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);
    }

    public function test_if_there_is_at_least_5_quizzes_after_seeding(): void
    {
        $this->assertTrue(Quiz::all()->count() > 5);
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
            'time' => "10",
            'description' => 'Test Description',
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

    public function test_if_increment_works_correctly_when_visiting_endpoint(): void
    {
        $quiz = Quiz::first();
        $this->assertEquals(0, $quiz->timesPlayed);
        $this->get(route('quiz:increment', [$quiz->id]))->assertStatus(204);
        $updatedQuiz = Quiz::where('id', $quiz->id)->firstOrFail();
        $this->assertEquals(1, $updatedQuiz->timesPlayed);
    }

    public function test_if_search_parameter_works_correctly(): void
    {
        $quiz = Quiz::first();
        $data = $this->getJson(route('quiz:index', ['searchQuery' => $quiz->title]))->json();
        $this->assertCount(1, $data['data']);
    }
}
