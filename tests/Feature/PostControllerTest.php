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

        $this->assertDatabaseCount('posts', 1);

        $response->assertForbidden();
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

    public function testUserCannotSeeIsPublishedCheckboxOnCreatePostPage()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('posts.create'));

        $response->assertDontSeeText('Is published');
    }

    public function testUserCannotSeeIsPublishedCheckboxOnEditPostPage()
    {
        $post = Post::factory()->create();

        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('posts.edit', $post));

        $response->assertDontSeeText('Is published');
    }

    public function testAdminUserCanSeeIsPublishedCheckboxOnCreatePostPage()
    {
        $user = User::factory()->admin()->create();

        $response = $this->actingAs($user)->get(route('posts.create'));

        $response->assertSeeText('Is published');
    }

    public function testPublisherUserCanSeeIsPublishedCheckboxOnCreatePostPage()
    {
        $user = User::factory()->publisher()->create();

        $response = $this->actingAs($user)->get(route('posts.create'));

        $response->assertSeeText('Is published');
    }

    public function testUserCannotSetPostPublishedWhenCreating()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('posts.store'), [
            'title' => 'test title',
            'post_text' => 'test post text',
            'is_published' => true,
        ]);

        $this->assertDatabaseCount('posts', 0);

        $response->assertSessionHasErrors(['is_published' => 'The is published field is prohibited.']);
    }

    public function testUserCannotSetPostPublishedWhenEditing()
    {
        $user = User::factory()->create();

        $post = Post::factory()->create();

        $response = $this->actingAs($user)->put(route('posts.update', $post),
            array_merge($post->toArray(), [
            'is_published' => true,
        ]));

        $this->assertDatabaseHas('posts', [
            'title' => $post->title,
            'is_published' => false
        ]);

        $response->assertSessionHasErrors(['is_published' => 'The is published field is prohibited.']);
    }

    public function testPublisherCanSetPostPublishedWhenCreating()
    {
        $user = User::factory()->publisher()->create();

        $response = $this->actingAs($user)->post(route('posts.store'), [
            'title' => 'test title',
            'post_text' => 'test post text',
            'is_published' => true,
        ]);

        $this->assertDatabaseHas('posts', [
            'title' => 'test title',
            'is_published' => true
        ]);

        $response->isRedirect(route('posts.index'));
    }

    public function testAdminCanSetPostPublishedWhenCreating()
    {
        $user = User::factory()->admin()->create();

        $response = $this->actingAs($user)->post(route('posts.store'), [
            'title' => 'test title',
            'post_text' => 'test post text',
            'is_published' => true,
        ]);

        $this->assertDatabaseHas('posts', [
            'title' => 'test title',
            'is_published' => true
        ]);

        $response->isRedirect(route('posts.index'));
    }

    public function testPublisherCanSetPostPublishedWhenEditing()
    {
        $user = User::factory()->publisher()->create();

        $post = Post::factory()->create();

        $response = $this->actingAs($user)->put(route('posts.update', $post),
            array_merge($post->toArray(), [
            'is_published' => true,
        ]));

        $this->assertDatabaseHas('posts', [
            'title' => $post->title,
            'is_published' => true
        ]);
    }

    public function testAdminCanSetPostPublishedWhenEditing()
    {
        $user = User::factory()->admin()->create();

        $post = Post::factory()->create();

        $response = $this->actingAs($user)->put(route('posts.update', $post),
            array_merge($post->toArray(), [
            'is_published' => true,
        ]));

        $this->assertDatabaseHas('posts', [
            'title' => $post->title,
            'is_published' => true
        ]);

        $response->isRedirect(route('posts.index'));
    }
}
