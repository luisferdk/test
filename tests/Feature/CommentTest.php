<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\User;

class CommentTest extends TestCase
{
  /**
   * A Comment Test
   *
   * @return void
   */
  use RefreshDatabase;

  protected $user;
  protected $post;
  protected $comment;

  function createData()
  {
    $this->user = User::create([
      'name' => 'Luis',
      'email' => 'luis@example.com',
      'password' => bcrypt('luis')
    ]);

    $this->post = $this->user->posts()->create([
      "title" => "Title Post",
      "description" => "Description Post"
    ]);

    $this->comment = $this->post->comments()->create([
      "description" => "I am a Comment",
      "user_id" => $this->user->id
    ]);
  }

  public function test_get_comment()
  {

    $this->createData();

    $response = $this->get('/posts');
    $response->assertSee("I am a Comment");

    $response->assertStatus(200);
  }

  public function test_create_comment()
  {

    $this->createData();

    $response = $this->get('/posts');
    $response->assertSee("I am a Comment");
    $response->assertStatus(200);

    $response = $this->post('/comments', [
      'description' => "I am a new Comment",
      'user_id' => $this->user->id,
      'post_id' => $this->post->id,
    ]);
    $response->assertRedirect('/posts');

    $response = $this->get('/posts');
    $response->assertSee('I am a new Comment');
  }


  public function test_edit_comment()
  {

    $this->createData();

    $response = $this->get("/comments/{$this->comment->id}/edit");
    $response->assertSee("I am a Comment");
    $response->assertStatus(200);

    $response = $this->put("/comments/{$this->comment->id}", [
      'description' => 'I am a Comment edited',
      'user_id' => $this->user->id
    ]);

    $response->assertRedirect("/posts");
  }

  public function test_delete_comment()
  {
    $this->createData();

    $response = $this->delete("/comments/{$this->comment->id}");
    $response->assertRedirect("/posts");
  }
}
