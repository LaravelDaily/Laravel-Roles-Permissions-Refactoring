<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

class PostControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function testNonAdminUserCannotDeletePost()
    {
        $post = Post::factory()->create();

        $user = User::factory()->create();

        $response = $this->actingAs($user)->delete(route('posts.destroy', $post));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testAdminUserCanDeletePost()
    {
        $post = Post::factory()->create();

        $user = User::factory()->admin()->create();

        $response = $this->actingAs($user)->delete(route('posts.destroy', $post));

        $this->assertDeleted($post);

        $response->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect(route('posts.index'));
    }
}