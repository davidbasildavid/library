<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Book;

class BookReservationTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
    public function a_book_can_be_added_to_the_library()
    {
		$this->withoutExceptionHandling();

		$response = $this->post('/books', [
			'title' => 'Cool book title',
			'author' => 'David Basil'
		]);

		$response->assertOk();

		$this->assertCount(1, Book::get());
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
	public function a_book_can__be_updated()
	{
		$this->withoutExceptionHandling();

		$this->post('/books', [
			'title' => 'Cool title',
			'author' => 'David Basil'
		]);

		$book = Book::first();

		$response = $this->put('/books/'.$book->id, [
			'title' => 'New title',
			'author' => 'New Author'
		]);

		$this->assertEquals('New title', Book::first()->title);
		$this->assertEquals('New Author', Book::first()->author);

	}

}
