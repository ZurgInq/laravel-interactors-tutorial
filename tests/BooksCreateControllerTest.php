<?php

use Lib\Bookshelf\Interactors\AddBook;

class BooksCreateControllerTest extends TestCase
{
    public function testCallsInteractor()
    {
        $attributes = ['title' => '1984', 'author' => 'George Orwell'];        
        
        $addBook = Mockery::mock(AddBook::class);
        $this->app->instance(AddBook::class, $addBook);
        $addBook->expects()->__invoke($attributes);
        
        $response = $this->call('POST', '/books', $attributes);
    }
}
