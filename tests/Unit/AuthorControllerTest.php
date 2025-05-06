<?php

namespace Tests\Feature;

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the index method.
     */
    public function test_index_displays_authors(): void
    {
        Author::factory()->count(3)->create();

        $response = $this->get(route('author.index'));

        $response->assertStatus(200);
        $response->assertViewIs('author.index');
        $response->assertViewHas('authors');
    }

    /**
     * Test the create method.
     */
    public function test_create_displays_form(): void
    {
        $response = $this->get(route('author.create'));

        $response->assertStatus(200);
        $response->assertViewIs('author.create');
    }

    /**
     * Test the store method.
     */
    public function test_store_creates_author(): void
    {
        $data = [
            'name' => 'John Doe',
            'birthday' => '01/01/1980',
        ];

        $response = $this->post(route('author.store'), $data);

        $response->assertRedirect(route('author.index'));
        $this->assertDatabaseHas('authors', $data);
    }

    /**
     * Test the show method.
     */
    public function test_show_displays_author(): void
    {
        $author = Author::factory()->create();

        $response = $this->get(route('author.show', $author));

        $response->assertStatus(200);
        $response->assertViewIs('author.show');
        $response->assertViewHas('author', $author);
    }

    /**
     * Test the edit method.
     */
    public function test_edit_displays_form(): void
    {
        $author = Author::factory()->create();

        $response = $this->get(route('author.edit', $author));

        $response->assertStatus(200);
        $response->assertViewIs('author.edit');
        $response->assertViewHas('author', $author);
    }

    /**
     * Test the update method.
     */
    public function test_update_modifies_author(): void
    {
        $author = Author::factory()->create();
        $data = [
            'name' => 'Jane Doe',
            'birthday' => '02/02/1990',
        ];

        $response = $this->put(route('author.update', $author), $data);

        $response->assertRedirect(route('author.index'));
        $this->assertDatabaseHas('authors', $data);
    }

    /**
     * Test the destroy method.
     */
    public function test_destroy_deletes_author(): void
    {
        $author = Author::factory()->create();

        $response = $this->delete(route('author.destroy', $author));

        $response->assertRedirect(route('author.index'));
        $this->assertDatabaseMissing('authors', ['id' => $author->id]);
    }
}