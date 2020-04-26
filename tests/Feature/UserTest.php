<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\User;

class UserTest extends TestCase
{
  /**
   * A User Test
   *
   * @return void
   */

  use RefreshDatabase;

  protected $user;

  function createUser()
  {
    $this->user = User::create([
      'name' => 'Luis',
      'email' => 'luis@example.com',
      'password' => bcrypt('luis')
    ]);
  }

  public function test_get_users()
  {
    $this->createUser();

    $response = $this->get('/users');
    $response->assertStatus(403);

    $response = $this->actingAs($this->user)->get('/users');
    $response->assertStatus(200);
  }

  public function test_create_user()
  {
    $this->createUser();

    $response = $this->actingAs($this->user)->post('/users', [
      'name' => 'Peter',
      'email' => 'peter@example.com',
      'password' => 'peter2020',
      'password_confirmation' => 'peter2020',
    ]);

    $response->assertRedirect('/users');
  }

  public function test_edit_user()
  {
    $this->createUser();

    $newUser = User::create([
      'name' => 'Peter',
      'email' => 'peter@example.com',
      'password' => bcrypt('peter')
    ]);

    $response = $this->actingAs($this->user)->put("/users/{$newUser->id}", [
      "email" => "peter@example.com",
      "name" => "Peter Parker"
    ]);
    $response->assertRedirect('/users');

    $response = $this->actingAs($this->user)->get('/users');
    $response->assertSee('Peter Parker');
  }

  public function test_delete_user()
  {
    $this->createUser();

    $newUser = User::create([
      'name' => 'Peter',
      'email' => 'peter@example.com',
      'password' => bcrypt('peter')
    ]);

    $response = $this->actingAs($this->user)->delete("/users/{$newUser->id}");
    $response->assertRedirect('/users');
  }
}
