<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Book;

class BookManagementTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
    public function a_book_can_be_added_to_the_library()
    {
		//$this->withoutExceptionHandling();

		$response = $this->post('/books', [
			'title' => 'Cool book title',
			'author' => 'David Basil'
		]);

		$book = Book::first();

		$this->assertCount(1, Book::get());

		$response->assertRedirect($book->path());
    }

	/** @test */
	public function a_title_is_required()
	{
		//$this->withoutExceptionHandling();

		$response = $this->post('/books', [
			'title' => '',
			'author' => 'David Basil'
		]);

		$response->assertSessionHasErrors('title');
	}

	/** @test */
	public function an_author_is_required()
	{
		//$this->withoutExceptionHandling();

		$response = $this->post('/books', [
			'title' => 'Cool title',
			'author' => ''
		]);

		$response->assertSessionHasErrors('author');
	}

	/** @test */
	public function a_book_can_be_updated()
	{
		$this->withoutExceptionHandling();

		$this->post('/books', [
			'title' => 'Cool title',
			'author' => 'David Basil'
		]);

		$book = Book::first();

		$response = $this->put($book->path(), [
			'title' => 'New title',
			'author' => 'New Author'
		]);

		$this->assertEquals('New title', Book::first()->title);
		$this->assertEquals('New Author', Book::first()->author);

		$response->assertRedirect($book->fresh()->path());

	}

	/** @test */
	public function a_book_can_be_deleted()
	{
		$this->withoutExceptionHandling();

		$this->post('/books', [
			'title' => 'Cool title',
			'author' => 'David Basil'
		]);

		$book = Book::first();

		$response = $this->delete($book->path());

		$this->assertCount(0, Book::get());

		$response->assertRedirect('/books');
	}

}
