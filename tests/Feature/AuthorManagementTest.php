<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Carbon\Carbon;
use App\Author;

class AuthorManagementTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	public function an_author_can_be_created()
	{
		$this->withoutExceptionHandling();

		$this->post('/author', [
			'name' => 'Author name',
			'dob' => '1989-12-26',
		]);

		$author = Author::get();

		$this->assertCount(1, $author);

	}
}
