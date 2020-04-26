<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Post;

class PostTest extends TestCase
{
  /**
   * Post Test
   *
   * @return void
   */

  use RefreshDatabase;

  public function test_get_posts()
  {
    $response = $this->get('/posts');
    $response->assertStatus(200);
  }

  public function test_create_post()
  {
    $response = $this->get('/posts/create');
    $response->assertStatus(200);

    $response = $this->post('/posts', [
      'title' => 'Title Post',
      'description' => 'Lorem ipsum of Post',
      'user_id' => 1
    ]);

    $response->assertRedirect('/posts');
  }

  public function test_edit_post()
  {
    $post = Post::create([
      'title' => 'Title Post',
      'description' => 'Lorem ipsum of Post',
      'user_id' => 1
    ]);

    $response = $this->get("/posts/$post->id/edit");
    $response->assertStatus(200);

    $response = $this->put("/posts/$post->id", [
      'title' => 'Title Post Update',
      'description' => 'Lorem ipsum of Post',
      'user_id' => 1
    ]);

    $response->assertRedirect('/posts');
  }

  public function test_delete_post()
  {
    $post = Post::create([
      'title' => 'Title Post',
      'description' => 'Lorem ipsum of Post',
      'user_id' => 1
    ]);

    $response = $this->delete("/posts/$post->id");
    $response->assertRedirect('/posts');
  }
}
