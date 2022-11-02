<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class booksapitest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function can_get_all_books()
    {
        $books = Book::factory(4)->create();

        $response = $this->getJson(route('books.index'));

        $response->assertJsonFragment([
            'title' => $books[0]->title


        ])->assertJsonFragment([
            'title' => $books[1]->title
        ]);
    }

    /** @test */
    function can_get_one_book()
    {
        $books = Book::factory()->create();

        $response = $this->getJson(route('books.show', $books));

        $response->assertJsonFragment([
            'title' => $books->title

        ]);





    }

    function can_create_books()
{

$this->postJson(route('books.store'),[])
->assertJsonValidationErrorFor('title');

$this->postJson(route('books.store'),[

    'title' => 'my new book'])->assertJsonFragment([

'title ' => 'my new book'
    ]);

}


function can_update_books()
{
$books = Book::factory()->create();

$this->patchJson(route('books.index', $book),[

'title' => 'edited book'

])->assertJsonFragment([

    'title' => 'edited book'




]);



}

}
