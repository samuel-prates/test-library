<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the index method.
     */
    public function test_index_displays_books(): void
    {
        Book::factory()
            ->count(3)
            ->has(Author::factory()->count(2), 'authors')
            ->create();

        $response = $this->get(route('book.index'));

        $response->assertStatus(200);
        $response->assertViewIs('book.index');
        $response->assertViewHas('books');
    }

    /**
     * Test the create method.
     */
    public function test_create_displays_form_with_authors(): void
    {
        Author::factory()->count(3)->create();

        $response = $this->get(route('book.create'));

        $response->assertStatus(200);
        $response->assertViewIs('book.create');
        $response->assertViewHas('authors');
    }

    /**
     * Test the store method.
     */
    public function test_store_creates_book_with_authors(): void
    {
        $authors = Author::factory()->count(2)->create();

        $data = [
            'title' => 'Test Book',
            'year' => '2023',
            'authors' => $authors->pluck('id')->toArray(),
        ];

        $response = $this->post(route('book.store'), $data);

        $response->assertRedirect(route('book.index'));
        $this->assertDatabaseHas('books', ['title' => 'Test Book', 'year' => '2023']);
        foreach ($authors as $author) {
            $this->assertDatabaseHas('author_book', ['author_id' => $author->id]);
        }
    }

    /**
     * Test the show method.
     */
    public function test_show_displays_book(): void
    {
        $book = Book::factory()->create();

        $response = $this->get(route('book.show', $book));

        $response->assertStatus(200);
        $response->assertViewIs('book.show');
        $response->assertViewHas('book', $book);
    }

    /**
     * Test the edit method.
     */
    public function test_edit_displays_form_with_authors_and_selected_authors(): void
    {
        $book = Book::factory()->create();
        $authors = Author::factory()->count(3)->create();
        $book->authors()->attach($authors->pluck('id')->toArray());

        $response = $this->get(route('book.edit', $book));

        $response->assertStatus(200);
        $response->assertViewIs('book.edit');
        $response->assertViewHas('book', $book);
        $response->assertViewHas('authors');
        $response->assertViewHas('selectedAuthors', $book->authors->pluck('id')->toArray());
    }

    /**
     * Test the update method.
     */
    public function test_update_modifies_book_and_authors(): void
    {
        $book = Book::factory()->create();
        $authors = Author::factory()->count(2)->create();
        $book->authors()->attach($authors->pluck('id')->toArray());

        $newAuthors = Author::factory()->count(2)->create();
        $data = [
            'title' => 'Updated Book',
            'year' => '2024',
            'authors' => $newAuthors->pluck('id')->toArray(),
        ];

        $response = $this->put(route('book.update', $book), $data);

        $response->assertRedirect(route('book.index'));
        $this->assertDatabaseHas('books', ['title' => 'Updated Book', 'year' => '2024']);
        foreach ($newAuthors as $author) {
            $this->assertDatabaseHas('author_book', ['author_id' => $author->id]);
        }
    }

    /**
     * Test the destroy method.
     */
    public function test_destroy_deletes_book(): void
    {
        $book = Book::factory()->create();

        $response = $this->delete(route('book.destroy', $book));

        $response->assertRedirect(route('book.index'));
        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }
}
