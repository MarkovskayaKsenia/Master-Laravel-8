<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_no_blog_posts_when_nothing_in_database()
    {
        $response = $this->get('/posts');

        $response->assertSeeText('No posts found!');
    }

    public function test_see_1_blog_post_when_there_is_with_no_comments()
    {
        //Arrange
        $post = $this->createDummyBlogPost();

        //Act
        $response = $this->get('/posts');

        //Assert
        $response->assertSeeText('New title');
        $response->assertSeeText('No comments yet!');
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New title'
        ]);
    }

    public function test_see_1_blog_post_with_comments()
    {
        $post = $this->createDummyBlogPost();
        Comment::factory()->count(4)->create(['blog_post_id' => $post->id]);
        $response = $this->get('/posts');
        $response->assertSeeText('4 comments');
    }

    public function test_store_valid()
    {
        $params = [
            'title' => 'Valid title',
            'content' => 'At least 10 characters'
        ];

        $this->actingAs($this->user())
            ->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'The blog post was created');
    }

    public function test_store_fail()
    {
        $params = [
            'title' => 'x',
            'content' => 'x'
        ];

        $this->actingAs($this->user())
            ->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('errors');

        $messages = session('errors')->getMessages();

        $this->assertEquals($messages['title'][0], 'The title must be at least 5 characters.');
        $this->assertEquals($messages['content'][0], 'The content must be at least 10 characters.');
    }

    public function test_update_valid()
    {
        $user =$this->user();
        $post = $this->createDummyBlogPost($user->id);

        $this->assertDatabaseHas('blog_posts', [
            "title" => "New title",
            "content" => "Content of the blog post",
        ]);

        $params = [
            'title' => 'A new named title',
            'content' => 'Content was changed!!!'
        ];

        $this->actingAs($user)
            ->put("/posts/{$post->id}", $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Blog post was updated');
        $this->assertDatabaseMissing('blog_posts', $post->toArray());
    }

    public function test_delete()
    {
        $user = $this->user();
        $post = $this->createDummyBlogPost($user->id);

        $this->actingAs($user)
            ->delete("/posts/{$post->id}")
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Blog post was deleted!');
       // $this->assertDatabaseMissing('blog_posts', ['id' => $post->id]);
        $this->assertSoftDeleted('blog_posts', ['id' => $post->id]);

    }

    private function createDummyBlogPost($userId = null): BlogPost
    {
        /* $post = new BlogPost();
         $post->title = 'New title';
         $post->content = 'Content of the blog post';
         $post->save();*/

        return BlogPost::factory()->newTitle()->create([
            'user_id' => $userId ?? $this->user()->id,
        ]);
        // return $post;
    }
}
